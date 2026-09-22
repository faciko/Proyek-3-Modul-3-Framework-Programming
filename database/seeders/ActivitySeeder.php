<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::create([
            'title' => 'Belajar Laravel',
            'description' => 'Mempelajari dasar Laravel',
            'activity_date' => '2026-09-22',
            'category' => 'Akademik',
            'status' => 'Planned',
        ]);

        Activity::create([
            'title' => 'Nonton Avengers',
            'description' => 'Menonton film Avengers End Game',
            'activity_date' => '2026-9-29',
            'category' => 'Hiburan',
            'status' => 'OnGoing'
        ]);

        Activity::create([
            'title' => 'Olahraga Padel',
            'description' => 'Bermain Padel 2 jam',
            'activity_date' => '2026-9-29',
            'category' => 'Olahraga',
            'status' => 'Done'
        ]);

        Activity::create([
            'title' => 'Belajar Filsafat',
            'description' => 'Mempelajari Stoikisme',
            'activity_date' => '2026-9-29',
            'category' => 'Ilmu',
            'status' => 'OnGoing'
        ]);

        Activity::create([
            'title' => 'Nonton Avengers',
            'description' => 'Menonton film Avengers Infinity War',
            'activity_date' => '2026-9-29',
            'category' => 'Hiburan',
            'status' => 'Done'
        ]);
    }
}
