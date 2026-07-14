<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\DiagnosisResult;
use App\Models\RoadmapItem;
use App\Models\RoadmapProgress;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RoadmapController extends Controller
{
    public function index(Request $request): Response
    {
        $careers = Career::select('id', 'name', 'slug', 'icon')->get();

        $selectedCareerId = (int) $request->input('career_id', $careers->first()?->id ?? 0);

        $recentResult = null;
        if ($request->user()) {
            $recentResult = DiagnosisResult::where('user_id', $request->user()->id)
                ->where('career_id', $selectedCareerId)
                ->latest()
                ->first();
        }

        $cfResults = [];
        if ($recentResult && $recentResult->cf_results) {
            $cfResults = collect($recentResult->cf_results)
                ->map(function ($item) {
                    return [
                        'career_id' => $item['career_id'],
                        'career_name' => $item['career_name'],
                        'cf' => $item['cf'],
                        'percentage' => $item['percentage'],
                        'conclusion' => $item['conclusion'],
                        'show_roadmap' => $item['cf'] >= 0.8,
                    ];
                })
                ->values()
                ->toArray();
        }

        $items = [];
        $progressCount = 0;
        $totalItems = 0;

        if ($selectedCareerId > 0) {
            $items = RoadmapItem::where('career_id', $selectedCareerId)
                ->orderBy('order')
                ->get()
                ->map(function ($item) use ($request) {
                    $progress = RoadmapProgress::where('user_id', $request->user()->id)
                        ->where('roadmap_item_id', $item->id)
                        ->first();

                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        'description' => $item->description,
                        'order' => $item->order,
                        'completed' => $progress !== null && $progress->completed_at !== null,
                        'completed_at' => $progress?->completed_at?->format('d M Y'),
                    ];
                });

            $totalItems = $items->count();
            $progressCount = $items->where('completed', true)->count();
        }

        return Inertia::render('roadmap', [
            'careers' => $careers,
            'selectedCareerId' => $selectedCareerId,
            'hasDiagnosis' => $recentResult !== null,
            'items' => $items,
            'progressCount' => $progressCount,
            'totalItems' => $totalItems,
            'cfResults' => $cfResults,
        ]);
    }

    public function toggle(Request $request)
    {
        $data = $request->validate([
            'roadmap_item_id' => 'required|exists:roadmap_items,id',
        ]);

        $userId = $request->user()->id;
        $itemId = $data['roadmap_item_id'];

        $progress = RoadmapProgress::where('user_id', $userId)
            ->where('roadmap_item_id', $itemId)
            ->first();

        if ($progress) {
            if ($progress->completed_at) {
                $progress->delete();
            } else {
                $progress->update(['completed_at' => now()]);
            }
        } else {
            RoadmapProgress::create([
                'user_id' => $userId,
                'roadmap_item_id' => $itemId,
                'completed_at' => now(),
            ]);
        }

        return back();
    }
}
