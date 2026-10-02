<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ActivityService
{
    public function create(array $data, ?UploadedFile $poster = null): Activity
    {
        $data['status'] = 'draft';
        $data['poster_path'] = $this->storePoster($poster);

        return Activity::create($data);
    }

    public function update(Activity $activity, array $data, ?UploadedFile $poster = null): Activity
    {
        $newPosterPath = $this->storePoster($poster);
        $oldPosterPath = $activity->poster_path;

        if ($newPosterPath !== null) {
            $data['poster_path'] = $newPosterPath;
        }

        $activity->update($data);

        if ($newPosterPath !== null && $oldPosterPath !== null) {
            Storage::disk('public')->delete($oldPosterPath);
        }

        return $activity;
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw new DomainException('Hanya kegiatan draft yang dapat dipublikasikan.');
        }

        if (! $this->isPublishable($activity)) {
            throw new DomainException('Kegiatan belum lengkap dan belum dapat dipublikasikan.');
        }

        $activity->update(['status' => 'published']);

        return $activity;
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw new DomainException('Hanya kegiatan published yang dapat diselesaikan.');
        }

        $activity->update(['status' => 'completed']);

        return $activity;
    }

    private function isPublishable(Activity $activity): bool
    {
        return $activity->category_id !== null
            && $activity->code !== null
            && $activity->title !== null
            && $activity->location !== null
            && $activity->start_at !== null
            && $activity->end_at !== null
            && $activity->capacity > 0;
    }

    private function storePoster(?UploadedFile $poster): ?string
    {
        return $poster?->store('activity-posters', 'public');
    }
}
