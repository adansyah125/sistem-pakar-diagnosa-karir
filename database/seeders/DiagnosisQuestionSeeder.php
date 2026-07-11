<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\DiagnosisQuestion;
use Illuminate\Database\Seeder;

class DiagnosisQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $careers = Career::all()->keyBy('slug');

        $questionsByCareer = [
            'frontend-developer' => [
                [
                    'question' => 'Seberapa mahir Anda menggunakan HTML dan CSS?',
                    'options' => [
                        ['label' => 'Tidak bisa', 'score' => 0],
                        ['label' => 'Dasar-dasar saja', 'score' => 1],
                        ['label' => 'Mahir membuat layout kompleks', 'score' => 2],
                        ['label' => 'Sangat mahir dengan animasi & responsif', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan framework JavaScript?',
                    'options' => [
                        ['label' => 'Tidak pernah pakai', 'score' => 0],
                        ['label' => 'Pernah coba satu framework', 'score' => 1],
                        ['label' => 'Mahir satu framework (React/Vue/Angular)', 'score' => 2],
                        ['label' => 'Mahir lebih dari satu framework', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang responsive design?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu media query dasar', 'score' => 1],
                        ['label' => 'Bisa bikin layout responsif', 'score' => 2],
                        ['label' => 'Menguasai mobile-first & cross-browser', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan Anda dalam mengintegrasikan API?',
                    'options' => [
                        ['label' => 'Belum pernah', 'score' => 0],
                        ['label' => 'Pernah consume API sederhana', 'score' => 1],
                        ['label' => 'Bisa consume & handle error', 'score' => 2],
                        ['label' => 'Mahir dengan berbagai autentikasi API', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa familiar Anda dengan version control (Git)?',
                    'options' => [
                        ['label' => 'Tidak tahu', 'score' => 0],
                        ['label' => 'Tahu git add, commit, push', 'score' => 1],
                        ['label' => 'Bisa branching & merging', 'score' => 2],
                        ['label' => 'Mahir dengan git workflow tim', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa tingkat pemahaman Anda tentang TypeScript?',
                    'options' => [
                        ['label' => 'Tidak tahu TypeScript', 'score' => 0],
                        ['label' => 'Pernah dengar tapi belum mahir', 'score' => 1],
                        ['label' => 'Bisa menulis tipe dasar', 'score' => 2],
                        ['label' => 'Mahir dengan generic & utility types', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan Anda dalam debugging frontend?',
                    'options' => [
                        ['label' => 'Tidak bisa debug', 'score' => 0],
                        ['label' => 'Pakai console.log', 'score' => 1],
                        ['label' => 'Pakai browser devtools', 'score' => 2],
                        ['label' => 'Mahir dengan breakpoint & profiling', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang performance optimization di frontend?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu konsep lazy loading', 'score' => 1],
                        ['label' => 'Bisa optimasi gambar & bundle', 'score' => 2],
                        ['label' => 'Menguasai code splitting & caching', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan CSS framework / utility?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Pernah pakai Bootstrap', 'score' => 1],
                        ['label' => 'Mahir Tailwind CSS', 'score' => 2],
                        ['label' => 'Bisa buat design system sendiri', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa sering Anda membuat website dari nol?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => '1-2 project', 'score' => 1],
                        ['label' => '3-5 project', 'score' => 2],
                        ['label' => 'Lebih dari 5 project', 'score' => 3],
                    ],
                ],
            ],

            'backend-developer' => [
                [
                    'question' => 'Apa bahasa pemrograman backend yang Anda kuasai?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => 'Satu bahasa dasar', 'score' => 1],
                        ['label' => 'Satu bahasa dengan framework', 'score' => 2],
                        ['label' => 'Lebih dari satu bahasa/framework', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang database relational?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Bisa SELECT & JOIN sederhana', 'score' => 1],
                        ['label' => 'Mahir normalisasi & indexing', 'score' => 2],
                        ['label' => 'Menguasai query kompleks & optimasi', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana pemahaman Anda tentang RESTful API?',
                    'options' => [
                        ['label' => 'Tidak tahu', 'score' => 0],
                        ['label' => 'Tahu konsep dasar', 'score' => 1],
                        ['label' => 'Bisa membuat API sendiri', 'score' => 2],
                        ['label' => 'Mahir dengan best practices & versioning', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang autentikasi & authorization?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu konsep login/logout', 'score' => 1],
                        ['label' => 'Bisa implementasi JWT / Session', 'score' => 2],
                        ['label' => 'Mahir OAuth, RBAC, & middleware', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan ORM (Object Relational Mapping)?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Pernah pakai satu ORM', 'score' => 1],
                        ['label' => 'Mahir Eloquent / Doctrine / Sequelize', 'score' => 2],
                        ['label' => 'Bisa optimasi query dengan ORM', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan Anda dalam menulis unit test?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Tahu konsep testing', 'score' => 1],
                        ['label' => 'Bisa menulis test sederhana', 'score' => 2],
                        ['label' => 'Mahir TDD & mocking', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang keamanan backend?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu SQL injection & XSS', 'score' => 1],
                        ['label' => 'Bisa implementasi validasi & sanitasi', 'score' => 2],
                        ['label' => 'Menguasai enkripsi & secure coding', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan message queue / caching?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Tahu Redis / RabbitMQ', 'score' => 1],
                        ['label' => 'Pernah implementasi caching', 'score' => 2],
                        ['label' => 'Mahir dengan queue & cache strategy', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang server & deployment?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu cara deploy manual', 'score' => 1],
                        ['label' => 'Bisa setup server sederhana', 'score' => 2],
                        ['label' => 'Menguasai CI/CD & container', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Berapa banyak project backend yang pernah Anda buat?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => '1-2 project', 'score' => 1],
                        ['label' => '3-5 project', 'score' => 2],
                        ['label' => 'Lebih dari 5 project', 'score' => 3],
                    ],
                ],
            ],

            'fullstack-developer' => [
                [
                    'question' => 'Seberapa mahir Anda di sisi frontend?',
                    'options' => [
                        ['label' => 'Tidak bisa', 'score' => 0],
                        ['label' => 'HTML/CSS dasar', 'score' => 1],
                        ['label' => 'Bisa pakai framework frontend', 'score' => 2],
                        ['label' => 'Sangat mahir frontend', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa mahir Anda di sisi backend?',
                    'options' => [
                        ['label' => 'Tidak bisa', 'score' => 0],
                        ['label' => 'Bisa buat API sederhana', 'score' => 1],
                        ['label' => 'Mahir satu framework backend', 'score' => 2],
                        ['label' => 'Sangat mahir backend & database', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan Anda dalam mendesain database?',
                    'options' => [
                        ['label' => 'Tidak bisa', 'score' => 0],
                        ['label' => 'Bisa bikin tabel sederhana', 'score' => 1],
                        ['label' => 'Bisa normalisasi & relasi', 'score' => 2],
                        ['label' => 'Menguasai desain database kompleks', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan deployment fullstack?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Pernah deploy ke shared hosting', 'score' => 1],
                        ['label' => 'Bisa deploy ke VPS / Cloud', 'score' => 2],
                        ['label' => 'Mahir dengan Docker & CI/CD', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang state management?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu useState / useEffect', 'score' => 1],
                        ['label' => 'Pernah pakai Redux / Zustand', 'score' => 2],
                        ['label' => 'Mahir berbagai state management', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan Anda dalam debugging fullstack?',
                    'options' => [
                        ['label' => 'Tidak bisa', 'score' => 0],
                        ['label' => 'Bisa debug frontend atau backend saja', 'score' => 1],
                        ['label' => 'Bisa debug frontend & backend', 'score' => 2],
                        ['label' => 'Mahir debugging network & performance', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan version control & kolaborasi?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Git dasar individu', 'score' => 1],
                        ['label' => 'Branching & pull request', 'score' => 2],
                        ['label' => 'Mahir git workflow tim', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang authentication flow?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu login/logout dasar', 'score' => 1],
                        ['label' => 'Bisa implementasi JWT / session', 'score' => 2],
                        ['label' => 'Menguasai OAuth & SSO', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana pemahaman Anda tentang REST & GraphQL?',
                    'options' => [
                        ['label' => 'Tidak tahu', 'score' => 0],
                        ['label' => 'Tahu REST dasar', 'score' => 1],
                        ['label' => 'Mahir REST API', 'score' => 2],
                        ['label' => 'Menguasai REST & GraphQL', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Berapa banyak project fullstack yang pernah Anda buat?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => '1-2 project', 'score' => 1],
                        ['label' => '3-5 project', 'score' => 2],
                        ['label' => 'Lebih dari 5 project', 'score' => 3],
                    ],
                ],
            ],

            'mobile-developer' => [
                [
                    'question' => 'Bahasa pemrograman mobile apa yang Anda kuasai?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => 'Dasar Java / Kotlin / Swift', 'score' => 1],
                        ['label' => 'Mahir satu platform native', 'score' => 2],
                        ['label' => 'Mahir multiplatform (Flutter/RN)', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang UI/UX mobile?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu Material Design / HIG', 'score' => 1],
                        ['label' => 'Bisa bikin UI mobile yang baik', 'score' => 2],
                        ['label' => 'Menguasai adaptive & responsive mobile', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan API di mobile?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Pernah consume API', 'score' => 1],
                        ['label' => 'Bisa handle offline mode', 'score' => 2],
                        ['label' => 'Mahir dengan caching & sync', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang state management mobile?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu setState dasar', 'score' => 1],
                        ['label' => 'Pernah pakai Provider / Bloc', 'score' => 2],
                        ['label' => 'Mahir berbagai state management', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana pengalaman Anda dengan app store deployment?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Tahu prosesnya saja', 'score' => 1],
                        ['label' => 'Pernah deploy ke satu store', 'score' => 2],
                        ['label' => 'Mahir deploy ke Play Store & App Store', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang performance mobile?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu konsep optimasi', 'score' => 1],
                        ['label' => 'Bisa profiling & optimasi', 'score' => 2],
                        ['label' => 'Menguasai memory & battery optimization', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan local database mobile?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Tahu SQLite / Room', 'score' => 1],
                        ['label' => 'Pernah implementasi satu DB lokal', 'score' => 2],
                        ['label' => 'Mahir dengan berbagai DB lokal', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang push notification?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu konsepnya', 'score' => 1],
                        ['label' => 'Pernah implementasi FCM/APNs', 'score' => 2],
                        ['label' => 'Mahir dengan rich notification', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan Anda dalam menangani navigasi mobile?',
                    'options' => [
                        ['label' => 'Tidak bisa', 'score' => 0],
                        ['label' => 'Navigasi dasar', 'score' => 1],
                        ['label' => 'Navigasi kompleks dengan params', 'score' => 2],
                        ['label' => 'Deep linking & dynamic routing', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Berapa banyak aplikasi mobile yang pernah Anda buat?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => '1 aplikasi', 'score' => 1],
                        ['label' => '2-3 aplikasi', 'score' => 2],
                        ['label' => 'Lebih dari 3 aplikasi', 'score' => 3],
                    ],
                ],
            ],

            'devops' => [
                [
                    'question' => 'Seberapa paham Anda tentang Linux / command line?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Perintah dasar', 'score' => 1],
                        ['label' => 'Bisa administrasi server', 'score' => 2],
                        ['label' => 'Mahir scripting & automation', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan Docker?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Tahu konsep container', 'score' => 1],
                        ['label' => 'Bisa buat Dockerfile & compose', 'score' => 2],
                        ['label' => 'Mahir orchestration (K8s / Swarm)', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang CI/CD?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu konsepnya', 'score' => 1],
                        ['label' => 'Pernah setup pipeline sederhana', 'score' => 2],
                        ['label' => 'Mahir dengan GitHub Actions / Jenkins', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Pengalaman cloud provider apa yang Anda miliki?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => 'Tahu satu provider', 'score' => 1],
                        ['label' => 'Pernah deploy ke cloud', 'score' => 2],
                        ['label' => 'Mahir multi-cloud & infrastructure', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang networking?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu TCP/IP, DNS, HTTP', 'score' => 1],
                        ['label' => 'Bisa configure firewall & proxy', 'score' => 2],
                        ['label' => 'Menguasai load balancer & VPN', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan Infrastructure as Code?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Tahu konsepnya', 'score' => 1],
                        ['label' => 'Pernah pakai Terraform / Ansible', 'score' => 2],
                        ['label' => 'Mahir dengan IaC & versioning', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang monitoring & logging?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu tools monitoring', 'score' => 1],
                        ['label' => 'Pernah setup Prometheus / Grafana', 'score' => 2],
                        ['label' => 'Mahir dengan observability stack', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana pemahaman Anda tentang security infrastructure?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu SSL/TLS & firewall', 'score' => 1],
                        ['label' => 'Bisa implementasi secure config', 'score' => 2],
                        ['label' => 'Menguasai security best practices', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang database administration?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu backup & restore', 'score' => 1],
                        ['label' => 'Bisa setup replication', 'score' => 2],
                        ['label' => 'Mahir dengan clustering & sharding', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Berapa lama pengalaman Anda di bidang infrastruktur IT?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => 'Kurang dari 1 tahun', 'score' => 1],
                        ['label' => '1-3 tahun', 'score' => 2],
                        ['label' => 'Lebih dari 3 tahun', 'score' => 3],
                    ],
                ],
            ],

            'ui-ux-designer' => [
                [
                    'question' => 'Apa tools desain yang Anda kuasai?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => 'Satu tools dasar', 'score' => 1],
                        ['label' => 'Mahir satu tools (Figma/Sketch)', 'score' => 2],
                        ['label' => 'Mahir multi tools', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang user research?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu konsepnya', 'score' => 1],
                        ['label' => 'Pernah melakukan riset sederhana', 'score' => 2],
                        ['label' => 'Mahir dengan berbagai metode riset', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan Anda dalam membuat wireframe?',
                    'options' => [
                        ['label' => 'Tidak bisa', 'score' => 0],
                        ['label' => 'Bisa wireframe kertas', 'score' => 1],
                        ['label' => 'Bisa wireframe digital', 'score' => 2],
                        ['label' => 'Mahir dengan interactive prototype', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang design system?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu konsep komponen', 'score' => 1],
                        ['label' => 'Pernah bikin design system kecil', 'score' => 2],
                        ['label' => 'Mahir membangun & maintain DS', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana pemahaman Anda tentang typography & color theory?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu dasar', 'score' => 1],
                        ['label' => 'Bisa memilih font & warna baik', 'score' => 2],
                        ['label' => 'Menguasai hierarchy & accessibility', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang accessibility (a11y)?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu contrast ratio', 'score' => 1],
                        ['label' => 'Bisa desain dengan a11y dasar', 'score' => 2],
                        ['label' => 'Mahir dengan WCAG standards', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan usability testing?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Tahu konsepnya', 'score' => 1],
                        ['label' => 'Pernah melakukan testing', 'score' => 2],
                        ['label' => 'Rutin melakukan usability test', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang interaction design?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu animasi dasar', 'score' => 1],
                        ['label' => 'Bisa bikin micro-interactions', 'score' => 2],
                        ['label' => 'Menguasai motion design', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan presentasi & komunikasi desain Anda?',
                    'options' => [
                        ['label' => 'Kurang', 'score' => 0],
                        ['label' => 'Cukup', 'score' => 1],
                        ['label' => 'Baik', 'score' => 2],
                        ['label' => 'Sangat baik', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Berapa banyak project desain yang pernah Anda kerjakan?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => '1-2 project', 'score' => 1],
                        ['label' => '3-5 project', 'score' => 2],
                        ['label' => 'Lebih dari 5 project', 'score' => 3],
                    ],
                ],
            ],

            'data-analyst' => [
                [
                    'question' => 'Apa tools analisis data yang Anda kuasai?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => 'Excel / Google Sheets', 'score' => 1],
                        ['label' => 'SQL + Python / R', 'score' => 2],
                        ['label' => 'Mahir dengan BI tools (Tableau/Power BI)', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang SQL?',
                    'options' => [
                        ['label' => 'Tidak bisa', 'score' => 0],
                        ['label' => 'SELECT & WHERE dasar', 'score' => 1],
                        ['label' => 'JOIN, GROUP BY, subquery', 'score' => 2],
                        ['label' => 'Window functions & CTE', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan statistik Anda?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu mean, median, modus', 'score' => 1],
                        ['label' => 'Paham distribusi & korelasi', 'score' => 2],
                        ['label' => 'Mahir regresi & hipotesis testing', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang data visualization?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Bisa bikin chart dasar', 'score' => 1],
                        ['label' => 'Bisa dashboard interaktif', 'score' => 2],
                        ['label' => 'Menguasai storytelling with data', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan data cleaning?',
                    'options' => [
                        ['label' => 'Tidak pernah', 'score' => 0],
                        ['label' => 'Tahu konsepnya', 'score' => 1],
                        ['label' => 'Pernah cleaning dataset kecil', 'score' => 2],
                        ['label' => 'Mahir dengan data wrangling tools', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang data warehouse / ETL?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu konsep ETL', 'score' => 1],
                        ['label' => 'Pernah buat pipeline sederhana', 'score' => 2],
                        ['label' => 'Mahir dengan data warehouse', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Bagaimana kemampuan Anda dalam membuat laporan?',
                    'options' => [
                        ['label' => 'Kurang', 'score' => 0],
                        ['label' => 'Cukup', 'score' => 1],
                        ['label' => 'Baik', 'score' => 2],
                        ['label' => 'Sangat baik', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Seberapa paham Anda tentang business metrics?',
                    'options' => [
                        ['label' => 'Tidak paham', 'score' => 0],
                        ['label' => 'Tahu KPI dasar', 'score' => 1],
                        ['label' => 'Bisa menentukan metrics bisnis', 'score' => 2],
                        ['label' => 'Mahir dengan funnel & cohort analysis', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Apa pengalaman Anda dengan Python / R untuk analisis?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => 'Dasar pandas / numpy', 'score' => 1],
                        ['label' => 'Bisa analisis & visualisasi', 'score' => 2],
                        ['label' => 'Mahir dengan machine learning dasar', 'score' => 3],
                    ],
                ],
                [
                    'question' => 'Berapa banyak project analisis data yang pernah Anda kerjakan?',
                    'options' => [
                        ['label' => 'Tidak ada', 'score' => 0],
                        ['label' => '1-2 project', 'score' => 1],
                        ['label' => '3-5 project', 'score' => 2],
                        ['label' => 'Lebih dari 5 project', 'score' => 3],
                    ],
                ],
            ],
        ];

        foreach ($questionsByCareer as $slug => $questions) {
            $career = $careers->get($slug);
            if (!$career) {
                $this->command->warn("Career slug '{$slug}' not found, skipping.");
                continue;
            }

            foreach ($questions as $index => $q) {
                DiagnosisQuestion::create([
                    'career_id' => $career->id,
                    'question' => $q['question'],
                    'options' => $q['options'],
                    'order' => $index + 1,
                ]);
            }
        }

        $total = count($questionsByCareer, COUNT_RECURSIVE) - count($questionsByCareer);
        $this->command->info("{$total} soal diagnosa berhasil di-seed untuk " . count($questionsByCareer) . ' bidang karir.');
    }
}
