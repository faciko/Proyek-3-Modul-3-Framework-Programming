<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
       $validStatuses = [
            'Planned',
            'Ongoing',
            'Done',
        ];

        $status = $request->query('status');

        $query = Activity::query();

        if (in_array($status, $validStatuses, true)) {
            $query->where('status', $status);
        }

        $activities = $query
            ->orderBy('activity_date')
            ->get();

        return view(
            'activities.index',
            compact('activities', 'status')
        );
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function create(): View
    {
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('activities.create', compact('categories'));
    }

    public function store(
        StoreActivityRequest $request,
        ActivityService $service
    ): RedirectResponse {
        $activity = $service->create(
            $request->validated()
        );

        return redirect()
            ->route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Activity $activity): View
    {
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        try {
            $activity = $service->update(
                $activity,
                $request->validated()
            );
        } catch (DomainException $exception) {
            return back()
                ->withErrors([
                    'status' => $exception->getMessage(),
                ])
                ->withInput();
        }

        return redirect()
            ->route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return redirect()
            ->route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
