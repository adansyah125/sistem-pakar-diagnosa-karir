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
        $diagnosedCareerIds = DiagnosisResult::where('user_id', $request->user()->id)
            ->pluck('career_id')
            ->unique()
            ->values()
            ->toArray();

        $selectedCareerId = (int) $request->input('career_id', $careers->first()?->id ?? 0);
        $hasDiagnosis = in_array($selectedCareerId, $diagnosedCareerIds);

        $items = [];
        $progressCount = 0;
        $totalItems = 0;

        if ($selectedCareerId > 0 && $hasDiagnosis) {
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
            'diagnosedCareerIds' => $diagnosedCareerIds,
            'selectedCareerId' => $selectedCareerId,
            'hasDiagnosis' => $hasDiagnosis,
            'items' => $items,
            'progressCount' => $progressCount,
            'totalItems' => $totalItems,
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
