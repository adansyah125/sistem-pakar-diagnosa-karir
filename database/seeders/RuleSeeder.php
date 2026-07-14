<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\DiagnosisQuestion;
use App\Models\Rule;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = $this->getRulesByCareerSlug();

        $created = 0;

        foreach ($rules as $slug => $questionRules) {
            $questions = DiagnosisQuestion::whereHas('career', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })->orderBy('order')->get();

            foreach ($questionRules as $index => $targets) {
                $question = $questions->get($index);

                if (!$question) {
                    continue;
                }

                foreach ($targets as $target) {
                    $targetCareer = Career::where('slug', $target['slug'])->first();
                    if (!$targetCareer) {
                        continue;
                    }

                    Rule::create([
                        'question_id' => $question->id,
                        'career_id' => $targetCareer->id,
                        'min_score' => $target['min_score'],
                        'cf' => $target['cf'],
                    ]);
                    $created++;
                }
            }
        }

        $this->command->info("{$created} aturan CF berhasil di-seed.");
    }

    private function getRulesByCareerSlug(): array
    {
        return [
            'frontend-developer' => [
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.9], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'ui-ux-designer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7]],
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'ui-ux-designer', 'min_score' => 1, 'cf' => 0.4]],
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.6], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.5], ['slug' => 'mobile-developer', 'min_score' => 1, 'cf' => 0.4], ['slug' => 'ui-ux-designer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.3]],
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.6]],
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.5]],
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'ui-ux-designer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7]],
            ],

            'backend-developer' => [
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.9], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.6]],
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.5]],
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.6]],
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.5]],
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'devops', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'devops', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'devops', 'min_score' => 2, 'cf' => 0.6]],
                [['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.5]],
            ],

            'fullstack-developer' => [
                [['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'ui-ux-designer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.7]],
                [['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'devops', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.7]],
                [['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5]],
                [['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.6], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.5], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.5], ['slug' => 'mobile-developer', 'min_score' => 1, 'cf' => 0.4], ['slug' => 'devops', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.4]],
                [['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.5]],
                [['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.4], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.4]],
            ],

            'mobile-developer' => [
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.9], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.2]],
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'devops', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.3]],
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.3], ['slug' => 'data-analyst', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'mobile-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.3], ['slug' => 'ui-ux-designer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'mobile-developer', 'min_score' => 1, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.2]],
            ],

            'devops' => [
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.9], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.5]],
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'data-analyst', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.8]],
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5]],
                [['slug' => 'devops', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'devops', 'min_score' => 1, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.3]],
            ],

            'ui-ux-designer' => [
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.9], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.3], ['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.3]],
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.3], ['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'data-analyst', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.3], ['slug' => 'data-analyst', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'ui-ux-designer', 'min_score' => 1, 'cf' => 0.7], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.3]],
            ],

            'data-analyst' => [
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.9], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.8], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'fullstack-developer', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'devops', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.8]],
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'ui-ux-designer', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'frontend-developer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.4], ['slug' => 'devops', 'min_score' => 2, 'cf' => 0.4]],
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.6], ['slug' => 'ui-ux-designer', 'min_score' => 1, 'cf' => 0.2]],
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.7]],
                [['slug' => 'data-analyst', 'min_score' => 2, 'cf' => 0.7], ['slug' => 'backend-developer', 'min_score' => 2, 'cf' => 0.5], ['slug' => 'fullstack-developer', 'min_score' => 1, 'cf' => 0.3]],
                [['slug' => 'data-analyst', 'min_score' => 1, 'cf' => 0.7]],
            ],
        ];
    }
}
