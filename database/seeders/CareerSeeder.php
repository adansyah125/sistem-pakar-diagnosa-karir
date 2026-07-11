<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            [
                'name' => 'Frontend Developer',
                'slug' => 'frontend-developer',
                'description' => 'Frontend Developer bertanggung jawab mengembangkan tampilan antarmuka pengguna (UI) pada website atau aplikasi web. Mereka mengubah desain visual menjadi kode yang berfungsi di browser, memastikan pengalaman pengguna yang responsif, interaktif, dan menarik.',
                'skills' => [
                    'HTML, CSS, JavaScript',
                    'React / Vue / Angular',
                    'Tailwind CSS / Bootstrap',
                    'TypeScript',
                    'Responsive Design',
                    'REST API Integration',
                    'Version Control (Git)',
                ],
            ],
            [
                'name' => 'Backend Developer',
                'slug' => 'backend-developer',
                'description' => 'Backend Developer mengembangkan logika server, database, API, dan arsitektur yang mendukung aplikasi berjalan di sisi server. Mereka memastikan data diproses, disimpan, dan dikirimkan dengan aman serta efisien ke frontend.',
                'skills' => [
                    'PHP / Laravel',
                    'Node.js / Express',
                    'Python / Django',
                    'Database (MySQL, PostgreSQL)',
                    'RESTful API / GraphQL',
                    'Authentication & Authorization',
                    'Server Management',
                ],
            ],
            [
                'name' => 'Fullstack Developer',
                'slug' => 'fullstack-developer',
                'description' => 'Fullstack Developer menguasai pengembangan sisi frontend maupun backend. Mereka mampu membangun aplikasi secara menyeluruh dari antarmuka pengguna hingga logika server, database, dan deployment.',
                'skills' => [
                    'Frontend (React / Vue / Angular)',
                    'Backend (Laravel / Node.js)',
                    'Database & API Design',
                    'DevOps & Deployment',
                    'TypeScript / JavaScript',
                    'Version Control (Git)',
                    'Problem Solving',
                ],
            ],
            [
                'name' => 'Mobile Developer',
                'slug' => 'mobile-developer',
                'description' => 'Mobile Developer mengembangkan aplikasi untuk perangkat mobile berbasis Android dan iOS. Mereka menciptakan pengalaman pengguna yang optimal di smartphone dan tablet dengan performa tinggi.',
                'skills' => [
                    'Kotlin / Java (Android)',
                    'Swift (iOS)',
                    'Flutter / React Native',
                    'Mobile UI/UX Principles',
                    'REST API Integration',
                    'App Store Deployment',
                    'Performance Optimization',
                ],
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'DevOps Engineer menjembatani tim pengembangan dan operasi untuk mengotomatiskan proses build, test, dan deployment. Mereka memastikan infrastruktur aplikasi stabil, scalable, dan aman.',
                'skills' => [
                    'Docker & Kubernetes',
                    'CI/CD (GitHub Actions, Jenkins)',
                    'Cloud (AWS / GCP / Azure)',
                    'Linux Administration',
                    'Infrastructure as Code (Terraform)',
                    'Monitoring & Logging',
                    'Networking & Security',
                ],
            ],
            [
                'name' => 'UI/UX Designer',
                'slug' => 'ui-ux-designer',
                'description' => 'UI/UX Designer merancang tampilan visual dan pengalaman pengguna pada aplikasi atau website. Mereka melakukan riset pengguna, membuat wireframe, prototype, dan memastikan desain mudah digunakan serta estetis.',
                'skills' => [
                    'Figma / Adobe XD / Sketch',
                    'User Research & Testing',
                    'Wireframing & Prototyping',
                    'Visual Design & Typography',
                    'Design Systems',
                    'Interaction Design',
                    'HTML/CSS Dasar',
                ],
            ],
            [
                'name' => 'Data Analyst',
                'slug' => 'data-analyst',
                'description' => 'Data Analyst mengumpulkan, membersihkan, dan menganalisis data untuk menemukan wawasan yang mendukung pengambilan keputusan bisnis. Mereka menyajikan temuan dalam bentuk laporan, dashboard, dan visualisasi data.',
                'skills' => [
                    'SQL & Database Query',
                    'Python / R',
                    'Excel / Google Sheets',
                    'Tableau / Power BI',
                    'Statistical Analysis',
                    'Data Cleaning & Wrangling',
                    'Data Visualization',
                ],
            ],
        ];

        foreach ($careers as $career) {
            Career::create($career);
        }

        $this->command->info('7 data karir IT berhasil di-seed.');
    }
}
