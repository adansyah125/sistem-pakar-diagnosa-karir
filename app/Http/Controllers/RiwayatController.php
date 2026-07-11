<?php

namespace App\Http\Controllers;

use App\Models\DiagnosisQuestion;
use App\Models\DiagnosisResult;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RiwayatController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->input('search');

        $query = DiagnosisResult::with('career')
            ->where('user_id', $request->user()->id);

        if ($search) {
            $query->whereHas('career', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $perPage = 6;
        $paginator = $query->orderBy('created_at', 'desc')->paginate($perPage);

        $careerIds = collect($paginator->items())->pluck('career_id')->unique();
        $questionsByCareer = DiagnosisQuestion::whereIn('career_id', $careerIds)
            ->orderBy('order')
            ->get()
            ->groupBy('career_id');

        $results = collect($paginator->items())->map(function ($r) use ($questionsByCareer) {
            $maxScore = 30;
            $questions = $questionsByCareer->get($r->career_id, collect());
            $answers = $r->answers ?? [];

            $answersDetail = $questions->values()->map(function ($q, $i) use ($answers) {
                $score = $answers[$i] ?? 0;
                $selectedOption = collect($q->options)->firstWhere('score', $score);
                return [
                    'question' => $q->question,
                    'score' => $score,
                    'max_score' => 3,
                    'option_label' => $selectedOption['label'] ?? '-',
                ];
            });

            return [
                'id' => $r->id,
                'career_id' => $r->career_id,
                'career_name' => $r->career->name,
                'education' => $r->education,
                'skills' => $r->skills,
                'total_score' => $r->total_score,
                'max_score' => $maxScore,
                'percentage' => round($maxScore > 0 ? ($r->total_score / $maxScore) * 100 : 0),
                'conclusion' => $r->conclusion,
                'created_at' => $r->created_at->format('d M Y, H:i'),
                'answers_detail' => $answersDetail,
            ];
        });

        return Inertia::render('riwayat', [
            'results' => $results,
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'has_more_pages' => $paginator->hasMorePages(),
            ],
            'search' => $search,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $result = DiagnosisResult::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $result->delete();

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Riwayat diagnosa berhasil dihapus.',
        ]);

        return back();
    }
}
