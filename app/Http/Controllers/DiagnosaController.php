<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\DiagnosisQuestion;
use App\Models\DiagnosisResult;
use App\Services\InferenceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DiagnosaController extends Controller
{
    public function index(Request $request): Response
    {
        $careers = Career::orderBy('name')->get();
        $questions = DiagnosisQuestion::with('career')
            ->orderBy('career_id')
            ->orderBy('order')
            ->get()
            ->groupBy('career_id');

        $diagnosisResult = null;
        $resultId = $request->session()->get('diagnosis_result_id');

        if ($resultId) {
            $result = DiagnosisResult::with('career')->find($resultId);
            if ($result) {
                $diagnosisResult = [
                    'id' => $result->id,
                    'career_name' => $result->career->name,
                    'education' => $result->education,
                    'skills' => $result->skills,
                    'answers' => $result->answers,
                    'total_score' => $result->total_score,
                    'conclusion' => $result->conclusion,
                    'cf_results' => $result->cf_results,
                ];
            }
        }

        return Inertia::render('diagnosa', [
            'careers' => $careers,
            'questions' => $questions,
            'diagnosisResult' => $diagnosisResult,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'career_id' => ['required', 'exists:careers,id'],
            'education' => ['nullable', 'string', 'max:255'],
            'skills' => ['nullable', 'string', 'max:1000'],
            'answers' => ['required', 'array', 'size:10'],
            'answers.*' => ['required', 'integer', 'min:0', 'max:3'],
        ]);

        $selectedCareer = Career::findOrFail($validated['career_id']);

        $questions = DiagnosisQuestion::where('career_id', $validated['career_id'])
            ->orderBy('order')
            ->get();

        $answersByQuestion = [];
        foreach ($questions as $index => $question) {
            $answersByQuestion[$question->id] = $validated['answers'][$index];
        }

        $inferenceService = new InferenceService();
        $cfResults = $inferenceService->run($answersByQuestion);

        $totalScore = array_sum($validated['answers']);
        $maxScore = 30;
        $percentage = $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0;

        if ($percentage >= 80) {
            $conclusion = 'Sangat Sesuai';
        } elseif ($percentage >= 60) {
            $conclusion = 'Sesuai';
        } elseif ($percentage >= 40) {
            $conclusion = 'Cukup Sesuai';
        } else {
            $conclusion = 'Kurang Sesuai';
        }

        $result = DiagnosisResult::create([
            'user_id' => $request->user()->id,
            'career_id' => $validated['career_id'],
            'education' => $validated['education'],
            'skills' => $validated['skills'],
            'answers' => $validated['answers'],
            'total_score' => $totalScore,
            'conclusion' => $conclusion,
            'cf_results' => $cfResults,
        ]);

        $request->session()->flash('diagnosis_result_id', $result->id);

        return to_route('diagnosa');
    }
}
