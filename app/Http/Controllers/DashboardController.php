<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\DiagnosisResult;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $userId = $request->user()->id;

        $totalDiagnosa = DiagnosisResult::where('user_id', $userId)->count();
        $userRiwayatCount = DiagnosisResult::where('user_id', $userId)->count();

        $careerDistribution = DiagnosisResult::selectRaw('career_id, COUNT(*) as total')
            ->groupBy('career_id')
            ->with('career:id,name')
            ->get()
            ->map(function ($item) {
                return [
                    'career_name' => $item->career?->name ?? 'Unknown',
                    'total' => (int) $item->total,
                ];
            })
            ->sortByDesc('total')
            ->values();

        $maxTotal = $careerDistribution->max('total') ?? 1;

        return Inertia::render('dashboard', [
            'totalDiagnosa' => $totalDiagnosa,
            'userRiwayatCount' => $userRiwayatCount,
            'careerDistribution' => $careerDistribution,
            'maxTotal' => $maxTotal,
        ]);
    }
}
