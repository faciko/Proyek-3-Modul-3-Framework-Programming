<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use DomainException;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    /** @param array{participant_name: string, email: string} $data */
    public function register(Activity $activity, array $data): Registration
    {
        $this->ensureRegistrable($activity, $data['email']);

        return DB::transaction(function () use ($activity, $data): Registration {
            $registration = $activity->registrations()->create([
                ...$data,
                'registered_at' => now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }

    private function ensureRegistrable(Activity $activity, string $email): void
    {
        if ($activity->status !== 'published') {
            throw new DomainException('Pendaftaran hanya tersedia untuk kegiatan published.');
        }

        if ($activity->start_at->isPast()) {
            throw new DomainException('Pendaftaran ditutup karena kegiatan sudah dimulai.');
        }

        if ($activity->registered_count >= $activity->capacity) {
            throw new DomainException('Pendaftaran ditutup karena kapasitas telah penuh.');
        }

        if ($activity->registrations()->where('email', $email)->exists()) {
            throw new DomainException('Email ini sudah terdaftar pada kegiatan tersebut.');
        }
    }
}
