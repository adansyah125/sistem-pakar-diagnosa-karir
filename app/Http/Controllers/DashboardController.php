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

        $uniqueCareerCount = DiagnosisResult::where('user_id', $userId)
            ->distinct('career_id')
            ->count('career_id');

        $bestCareerResult = DiagnosisResult::where('user_id', $userId)
            ->orderByDesc('total_score')
            ->with('career')
            ->first();

        $bestCareer = null;
        if ($bestCareerResult) {
            $bestCareer = $bestCareerResult->career?->name;
        }

        $careers = Career::orderBy('name')->get();

        $careerDistribution = $careers->map(function ($career) use ($userId) {
            $count = DiagnosisResult::where('user_id', $userId)
                ->where('career_id', $career->id)
                ->count();

            return [
                'career_name' => $career->name,
                'total' => $count,
            ];
        })->values();

        $maxTotal = $careerDistribution->max('total') ?? 1;

        return Inertia::render('dashboard', [
            'totalDiagnosa' => $totalDiagnosa,
            'uniqueCareerCount' => $uniqueCareerCount,
            'bestCareer' => $bestCareer,
            'careerDistribution' => $careerDistribution,
            'maxTotal' => $maxTotal,
        ]);
    }
}
