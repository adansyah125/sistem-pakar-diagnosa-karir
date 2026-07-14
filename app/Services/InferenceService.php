<?php

namespace App\Services;

use App\Models\Career;
use App\Models\DiagnosisQuestion;
use App\Models\Rule;
use Illuminate\Support\Collection;

class InferenceService
{
    private Collection $rules;
    private Collection $careers;
    private array $cfResults;

    public function __construct()
    {
        $this->rules = Rule::with('career')->get();
        $this->careers = Career::all();
        $this->cfResults = [];
    }

    public function run(array $answers): array
    {
        $this->cfResults = [];
        $groupedRules = $this->rules->groupBy('question_id');

        foreach ($groupedRules as $questionId => $rules) {
            if (!isset($answers[$questionId])) {
                continue;
            }

            $answerScore = $answers[$questionId];
            $cfEvidence = $answerScore / 3;

            if ($cfEvidence <= 0) {
                continue;
            }

            foreach ($rules as $rule) {
                if ($answerScore < $rule->min_score) {
                    continue;
                }

                $cfContribution = $cfEvidence * $rule->cf;
                $careerId = $rule->career_id;

                if (!isset($this->cfResults[$careerId])) {
                    $this->cfResults[$careerId] = [
                        'career_id' => $careerId,
                        'career_name' => $rule->career->name,
                        'cf' => 0.0,
                        'evidence' => [],
                    ];
                }

                $oldCf = $this->cfResults[$careerId]['cf'];
                $this->cfResults[$careerId]['cf'] = $oldCf + $cfContribution * (1 - $oldCf);

                $this->cfResults[$careerId]['evidence'][] = [
                    'question_id' => $questionId,
                    'score' => $answerScore,
                    'cf_evidence' => $cfEvidence,
                    'cf_rule' => $rule->cf,
                    'cf_contribution' => $cfContribution,
                ];
            }
        }

        $this->addCareersWithoutResults();

        return $this->formatResults();
    }

    private function addCareersWithoutResults(): void
    {
        foreach ($this->careers as $career) {
            if (!isset($this->cfResults[$career->id])) {
                $this->cfResults[$career->id] = [
                    'career_id' => $career->id,
                    'career_name' => $career->name,
                    'cf' => 0.0,
                    'evidence' => [],
                ];
            }
        }
    }

    private function formatResults(): array
    {
        $results = collect($this->cfResults)
            ->sortByDesc('cf')
            ->values()
            ->map(function ($result) {
                $result['percentage'] = round($result['cf'] * 100);
                $result['conclusion'] = $this->getConclusion($result['cf']);
                return $result;
            })
            ->toArray();

        return $results;
    }

    public function getConclusion(float $cf): string
    {
        if ($cf >= 0.8) {
            return 'Sangat Sesuai';
        } elseif ($cf >= 0.6) {
            return 'Sesuai';
        } elseif ($cf >= 0.4) {
            return 'Cukup Sesuai';
        } else {
            return 'Kurang Sesuai';
        }
    }
}
