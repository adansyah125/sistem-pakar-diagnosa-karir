<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\RoadmapItem;
use Illuminate\Database\Seeder;

class RoadmapItemSeeder extends Seeder
{
    public function run(): void
    {
        $roadmaps = [
            'Frontend Developer' => [
                ['title' => 'HTML & CSS Fundamentals', 'description' => 'Pelajari dasar-dasar HTML untuk struktur halaman web dan CSS untuk styling. Kuasai semantic HTML, Flexbox, Grid, dan responsive design.'],
                ['title' => 'JavaScript Dasar', 'description' => 'Pelajari fundamental JavaScript: variabel, fungsi, DOM manipulation, event handling, dan ES6+ features.'],
                ['title' => 'Version Control (Git)', 'description' => 'Kuasai Git untuk version control: init, commit, branch, merge, pull request, dan kolaborasi dengan GitHub.'],
                ['title' => 'CSS Framework', 'description' => 'Pelajari framework CSS seperti Tailwind CSS atau Bootstrap untuk mempercepat pengembangan UI yang responsif.'],
                ['title' => 'JavaScript Framework (React/Vue/Angular)', 'description' => 'Kuasai satu framework JavaScript modern. React sangat populer dengan konsep komponen, state, dan hooks.'],
                ['title' => 'TypeScript', 'description' => 'Pelajari TypeScript untuk menambahkan tipe statis pada JavaScript, meningkatkan kualitas kode dan developer experience.'],
                ['title' => 'REST API Integration', 'description' => 'Pelajari cara mengintegrasikan REST API, mengelola state async, dan menampilkan data dari backend.'],
                ['title' => 'Deployment & Hosting', 'description' => 'Pelajari cara mendeploy aplikasi frontend ke Vercel, Netlify, atau platform hosting lainnya.'],
            ],
            'Backend Developer' => [
                ['title' => 'Programming Language Dasar', 'description' => 'Kuasai satu bahasa pemrograman backend seperti PHP, Python, atau Node.js. Pelajari sintaks, OOP, dan konsep dasar.'],
                ['title' => 'Database Fundamentals', 'description' => 'Pelajari database relasional (MySQL/PostgreSQL): table design, SQL queries, indexing, dan relationships.'],
                ['title' => 'Version Control (Git)', 'description' => 'Kuasai Git untuk version control: branching strategy, collaboration, dan code review workflow.'],
                ['title' => 'RESTful API Design', 'description' => 'Pelajari prinsip desain REST API: resource naming, HTTP methods, status codes, authentication, dan dokumentasi.'],
                ['title' => 'Authentication & Authorization', 'description' => 'Implementasi sistem login, JWT, OAuth, role-based access control, dan best practices keamanan.'],
                ['title' => 'Framework (Laravel/Django/Express)', 'description' => 'Kuasai framework backend populer. Laravel untuk PHP, Django untuk Python, atau Express untuk Node.js.'],
                ['title' => 'Server Management & Deployment', 'description' => 'Pelajari Linux server, web server (Nginx/Apache), environment setup, dan deployment ke production.'],
                ['title' => 'Testing & Debugging', 'description' => 'Pelajari unit testing, integration testing, API testing, dan debugging tools untuk backend.'],
            ],
            'Fullstack Developer' => [
                ['title' => 'Frontend Fundamentals', 'description' => 'Kuasai HTML, CSS, JavaScript dasar. Pahami DOM, event handling, dan responsive design.'],
                ['title' => 'Backend Fundamentals', 'description' => 'Pelajari satu bahasa backend (PHP/Node.js/Python), konsep server, request/response cycle, dan routing.'],
                ['title' => 'Database Design & Management', 'description' => 'Pelajari relational database, SQL, migrations, relationships, dan query optimization.'],
                ['title' => 'Version Control (Git)', 'description' => 'Kuasai Git workflow, branching, pull request, dan kolaborasi tim.'],
                ['title' => 'API Development & Integration', 'description' => 'Bangun REST API dari backend dan integrasikan dengan frontend. Pelajari CORS, axios/fetch.'],
                ['title' => 'Framework Frontend & Backend', 'description' => 'Kuasai satu stack: React + Laravel, Next.js + Prisma, atau Vue + Node.js.'],
                ['title' => 'DevOps & Deployment', 'description' => 'Pelajari deployment fullstack: environment variables, build process, CI/CD, dan hosting.'],
                ['title' => 'Testing & Debugging', 'description' => 'Pelajari testing di frontend dan backend, end-to-end testing, dan debugging workflow.'],
            ],
            'Mobile Developer' => [
                ['title' => 'Programming Language Dasar', 'description' => 'Kuasai Kotlin (Android), Swift (iOS), atau Dart (Flutter). Pelajari sintaks, OOP, dan konsep dasar.'],
                ['title' => 'Mobile UI/UX Principles', 'description' => 'Pelajari prinsip desain mobile: material design, human interface guidelines, layout, dan navigation.'],
                ['title' => 'Version Control (Git)', 'description' => 'Kuasai Git untuk version control dan kolaborasi dalam tim pengembangan mobile.'],
                ['title' => 'REST API Integration', 'description' => 'Pelajari HTTP client, JSON parsing, error handling, dan caching data dari API.'],
                ['title' => 'State Management', 'description' => 'Pelajari state management: Riverpod/Bloc (Flutter), ViewModel (Android), atau Combine (iOS).'],
                ['title' => 'Local Database', 'description' => 'Pelajari penyimpanan lokal: SQLite, Room (Android), CoreData (iOS), atau Hive/Isar (Flutter).'],
                ['title' => 'App Store Deployment', 'description' => 'Pelajari proses deploy ke Google Play Store dan Apple App Store: signing, build, dan review.'],
                ['title' => 'Performance Optimization', 'description' => 'Pelajari optimasi performa: memory management, lazy loading, image caching, dan profiling.'],
            ],
            'DevOps' => [
                ['title' => 'Linux Administration', 'description' => 'Kuasai command line Linux, file system, process management, user permissions, dan shell scripting.'],
                ['title' => 'Version Control (Git)', 'description' => 'Kuasai Git branching strategy, hooks, dan workflow untuk otomatisasi dan kolaborasi.'],
                ['title' => 'Networking & Security Fundamentals', 'description' => 'Pelajari TCP/IP, DNS, HTTP/HTTPS, firewall, SSL/TLS, dan praktik keamanan server.'],
                ['title' => 'Containerization (Docker)', 'description' => 'Pelajari Docker: images, containers, docker-compose, networking, dan volume management.'],
                ['title' => 'CI/CD Pipeline', 'description' => 'Bangun CI/CD pipeline dengan GitHub Actions, GitLab CI, atau Jenkins. Otomatisasi build, test, dan deploy.'],
                ['title' => 'Cloud Platform (AWS/GCP/Azure)', 'description' => 'Pelajari cloud services: compute, storage, database, networking, dan IAM di salah satu cloud provider.'],
                ['title' => 'Infrastructure as Code (Terraform)', 'description' => 'Pelajari Terraform untuk provisioning infrastruktur secara reproducible dan version-controlled.'],
                ['title' => 'Monitoring & Logging', 'description' => 'Pelajari monitoring server, logging centralized, alerting, dan observability tools (Prometheus, Grafana).'],
            ],
            'UI/UX Designer' => [
                ['title' => 'Design Thinking Process', 'description' => 'Pelajari proses Design Thinking: empathize, define, ideate, prototype, dan test untuk解决问题.'],
                ['title' => 'User Research Methods', 'description' => 'Pelajari metode riset pengguna: wawancara, survei, usability testing, dan analisis data pengguna.'],
                ['title' => 'Wireframing & Prototyping', 'description' => 'Pelajari membuat wireframe low-fi dan high-fi, serta prototype interaktif untuk testing.'],
                ['title' => 'Visual Design Principles', 'description' => 'Pelajari tipografi, color theory, hierarchy, layout, spacing, dan prinsip gestalt dalam desain.'],
                ['title' => 'Design Tools (Figma)', 'description' => 'Kuasai Figma: komponen, auto layout, variants, prototyping, kolaborasi, dan design system.'],
                ['title' => 'Design Systems', 'description' => 'Pelajari cara membangun dan mengelola design system yang konsisten dan scalable.'],
                ['title' => 'Usability Testing', 'description' => 'Pelajari cara merencanakan, menjalankan, dan menganalisis usability testing untuk validasi desain.'],
                ['title' => 'HTML/CSS Basics', 'description' => 'Pelajari dasar HTML dan CSS untuk memahami implementasi desain dan komunikasi dengan developer.'],
            ],
            'Data Analyst' => [
                ['title' => 'Statistics Fundamentals', 'description' => 'Pelajari statistik deskriptif dan inferensial: mean, median, distribusi, korelasi, dan hipotesis.'],
                ['title' => 'SQL & Database Query', 'description' => 'Kuasai SQL: SELECT, JOIN, GROUP BY, subqueries, window functions, dan query optimization.'],
                ['title' => 'Excel / Google Sheets', 'description' => 'Pelajari advanced Excel/Sheets: pivot table, VLOOKUP, conditional formatting, dan data analysis tools.'],
                ['title' => 'Python / R Programming', 'description' => 'Pelajari Python (pandas, numpy) atau R untuk data manipulation, analysis, dan automation.'],
                ['title' => 'Data Cleaning & Wrangling', 'description' => 'Pelajari teknik data cleaning: handling missing values, outliers, duplicates, dan data transformation.'],
                ['title' => 'Data Visualization', 'description' => 'Pelajari visualisasi data: matplotlib, seaborn, ggplot2, dan prinsip storytelling dengan data.'],
                ['title' => 'Dashboard Creation (Tableau/Power BI)', 'description' => 'Pelajari membuat dashboard interaktif dengan Tableau atau Power BI untuk business intelligence.'],
                ['title' => 'Business Analysis & Reporting', 'description' => 'Pelajari cara menerjemahkan data menjadi insight bisnis dan menyajikan laporan yang efektif.'],
            ],
        ];

        foreach ($roadmaps as $careerName => $items) {
            $career = Career::where('name', $careerName)->first();
            if (!$career) continue;

            foreach ($items as $order => $item) {
                RoadmapItem::create([
                    'career_id' => $career->id,
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'order' => $order + 1,
                ]);
            }
        }

        $this->command->info('Roadmap items berhasil di-seed untuk ' . count($roadmaps) . ' karir.');
    }
}
