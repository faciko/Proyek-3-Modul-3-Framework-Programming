<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;

class ActivityService
{
    public function create(array $data): Activity
    {
        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        $nextStatus = $data['status'];

        $this->ensureValidTransition(
            $activity->status,
            $nextStatus
        );

        $activity->update($data);

        return $activity;
    }

    private function ensureValidTransition(
        string $current,
        string $next
    ): void {
        $allowedTransitions = [
            'Planned' => ['Planned', 'Ongoing'],
            'Ongoing' => ['Ongoing', 'Done'],
            'Done' => ['Done'],
        ];

        if (! in_array($next, $allowedTransitions[$current], true)) {
            throw new DomainException(
                'Status tidak boleh mundur.'
            );
        }
    }
}
