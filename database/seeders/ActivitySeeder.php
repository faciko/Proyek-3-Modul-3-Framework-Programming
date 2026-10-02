<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $catAkademik = $categories->firstWhere('slug', 'akademik') ?? $categories[0];
        $catTeknologi = $categories->firstWhere('slug', 'teknologi') ?? $categories[1];
        $catOlahraga = $categories->firstWhere('slug', 'olahraga') ?? $categories[2];

        $activities = [
            [
                'code' => 'ACT-101',
                'title' => 'Workshop Pemrograman Web Modern dengan Laravel',
                'category_id' => $catTeknologi->id,
                'description' => 'Membahas arsitektur Laravel, MVC, Eloquent ORM, dan best practice.',
                'start_at' => now()->addDays(2)->setTime(9, 0),
                'end_at' => now()->addDays(2)->setTime(12, 0),
                'location' => 'Laboratorium Rekayasa Perangkat Lunak',
                'capacity' => 40,
                'status' => 'draft',
            ],
            [
                'code' => 'ACT-102',
                'title' => 'Seminar Kecerdasan Buatan dan Deep Learning',
                'category_id' => $catTeknologi->id,
                'description' => 'Pengenalan implementasi AI dalam industri kesehatan dan robotika.',
                'start_at' => now()->addDays(5)->setTime(13, 0),
                'end_at' => now()->addDays(5)->setTime(16, 0),
                'location' => 'Auditorium Gedung Utama Lt. 3',
                'capacity' => 150,
                'status' => 'published',
            ],
            [
                'code' => 'ACT-103',
                'title' => 'Kuliah Umum: Matematika Diskrit dalam Kriptografi',
                'category_id' => $catAkademik->id,
                'description' => 'Aplikasi teori bilangan dan aljabar abstrak pada keamanan siber.',
                'start_at' => now()->subDays(10)->setTime(8, 0),
                'end_at' => now()->subDays(10)->setTime(11, 0),
                'location' => 'Ruang Seminar Jurusan Informatika',
                'capacity' => 60,
                'status' => 'completed',
            ],
            [
                'code' => 'ACT-104',
                'title' => 'Turnamen Futsal Antar Angkatan Informatika Cup',
                'category_id' => $catOlahraga->id,
                'description' => 'Kompetisi persahabatan futsal mahasiswa Informatika semester 1 hingga 5.',
                'start_at' => now()->addDays(8)->setTime(15, 0),
                'end_at' => now()->addDays(8)->setTime(18, 0),
                'location' => 'Lapangan Olahraga Kampus',
                'capacity' => 80,
                'status' => 'published',
            ],
            [
                'code' => 'ACT-105',
                'title' => 'Bootcamp Algoritma dan Struktur Data',
                'category_id' => $catAkademik->id,
                'description' => 'Latihan intensif pemecahan masalah algoritma graf dan dynamic programming.',
                'start_at' => now()->addDays(12)->setTime(9, 0),
                'end_at' => now()->addDays(12)->setTime(15, 0),
                'location' => 'Lab Komputer Dasar 2',
                'capacity' => 35,
                'status' => 'draft',
            ],
            [
                'code' => 'ACT-106',
                'title' => 'Pelatihan Cloud Computing dan DevOps AWS',
                'category_id' => $catTeknologi->id,
                'description' => 'Deploy container Docker ke AWS ECS dan CI/CD pipeline.',
                'start_at' => now()->addDays(15)->setTime(10, 0),
                'end_at' => now()->addDays(15)->setTime(14, 0),
                'location' => 'Lab Cloud Computing',
                'capacity' => 50,
                'status' => 'published',
            ],
            [
                'code' => 'ACT-107',
                'title' => 'Kompetisi Catur Kilat Dies Natalis',
                'category_id' => $catOlahraga->id,
                'description' => 'Turnamen catur kilat sistem swiss 7 babak untuk mahasiswa dan dosen.',
                'start_at' => now()->subDays(3)->setTime(9, 0),
                'end_at' => now()->subDays(3)->setTime(17, 0),
                'location' => 'Selasar Gedung D3',
                'capacity' => 32,
                'status' => 'completed',
            ],
            [
                'code' => 'ACT-108',
                'title' => 'Bedah Paper Ilmiah: Natural Language Processing',
                'category_id' => $catAkademik->id,
                'description' => 'Diskusi kritis metodologi transformer model pada pemrosesan bahasa daerah.',
                'start_at' => now()->addDays(4)->setTime(13, 30),
                'end_at' => now()->addDays(4)->setTime(15, 30),
                'location' => 'Ruang Baca Perpustakaan',
                'capacity' => 25,
                'status' => 'published',
            ],
            [
                'code' => 'ACT-109',
                'title' => 'Workshop Cyber Security: Penetration Testing Basics',
                'category_id' => $catTeknologi->id,
                'description' => 'Praktik ethical hacking, vulnerability assessment, dan mitigasi bug.',
                'start_at' => now()->addDays(20)->setTime(8, 30),
                'end_at' => now()->addDays(20)->setTime(12, 30),
                'location' => 'Lab Jaringan Komputer',
                'capacity' => 45,
                'status' => 'draft',
            ],
            [
                'code' => 'ACT-110',
                'title' => 'Bimbingan Karir: Menembus Industri Tech Global',
                'category_id' => $catAkademik->id,
                'description' => 'Tips pembuatan CV ATS-friendly dan mock technical interview software engineer.',
                'start_at' => now()->subDays(15)->setTime(14, 0),
                'end_at' => now()->subDays(15)->setTime(16, 30),
                'location' => 'Ruang Teater Kampus',
                'capacity' => 120,
                'status' => 'completed',
            ],
            [
                'code' => 'ACT-111',
                'title' => 'Lomba Desain UI/UX Mobile App Figma',
                'category_id' => $catTeknologi->id,
                'description' => 'Perancangan prototipe aplikasi mobile ramah disabilitas.',
                'start_at' => now()->addDays(7)->setTime(9, 0),
                'end_at' => now()->addDays(7)->setTime(17, 0),
                'location' => 'Lab Multimedia',
                'capacity' => 50,
                'status' => 'published',
            ],
            [
                'code' => 'ACT-112',
                'title' => 'Fun Run 5K Mahasiswa Sehat',
                'category_id' => $catOlahraga->id,
                'description' => 'Lari santai mengelilingi kawasan kampus dalam rangka hari olahraga.',
                'start_at' => now()->addDays(10)->setTime(6, 0),
                'end_at' => now()->addDays(10)->setTime(9, 0),
                'location' => 'Start Lapangan Rektorat',
                'capacity' => 200,
                'status' => 'published',
            ],
            [
                'code' => 'ACT-113',
                'title' => 'Mini Bootcamp Git dan GitHub Collaboration',
                'category_id' => $catTeknologi->id,
                'description' => 'Praktik branching model, merge conflict resolution, dan PR review.',
                'start_at' => now()->addDays(18)->setTime(13, 0),
                'end_at' => now()->addDays(18)->setTime(16, 0),
                'location' => 'Lab Komputer 3',
                'capacity' => 40,
                'status' => 'draft',
            ],
            [
                'code' => 'ACT-114',
                'title' => 'Simulasi Sidang Tugas Akhir dan Proposal',
                'category_id' => $catAkademik->id,
                'description' => 'Latihan presentasi dan tanya jawab teknis menjelang sidang akhir semester.',
                'start_at' => now()->subDays(2)->setTime(8, 0),
                'end_at' => now()->subDays(2)->setTime(12, 0),
                'location' => 'Ruang Sidang 1',
                'capacity' => 30,
                'status' => 'completed',
            ],
            [
                'code' => 'ACT-115',
                'title' => 'Sharing Session: Membangun Startup Digital dari Kampus',
                'category_id' => $catTeknologi->id,
                'description' => 'Pengalaman alumni membangun platform SaaS dari masa kuliah hingga seed funding.',
                'start_at' => now()->addDays(25)->setTime(10, 0),
                'end_at' => now()->addDays(25)->setTime(12, 0),
                'location' => 'Auditorium Lt. 2',
                'capacity' => 100,
                'status' => 'draft',
            ],
        ];

        foreach ($activities as $act) {
            Activity::updateOrCreate(
                ['code' => $act['code']],
                $act
            );
        }
    }
}
