<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use App\Services\ActivityService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->only(['search', 'category_id', 'status', 'sort']);
        $filters['status'] = in_array($filters['status'] ?? null, ['draft', 'published', 'completed'], true)
            ? $filters['status']
            : null;
        $filters['sort'] = in_array($filters['sort'] ?? null, ['latest', 'oldest'], true)
            ? $filters['sort']
            : 'latest';

        $activities = Activity::query()
            ->with('category')
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('activities.index', compact('activities', 'categories', 'filters'));
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('activities.create', compact('categories'));
    }

    public function store(
        StoreActivityRequest $request,
        ActivityService $service
    ): RedirectResponse {
        $activity = $service->create(
            $request->safe()->except('poster'),
            $request->file('poster')
        );

        return redirect()
            ->route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Activity $activity): View
    {
        $categories = Category::orderBy('name')->get();

        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        $activity = $service->update(
            $activity,
            $request->safe()->except('poster'),
            $request->file('poster')
        );

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

    public function trash(): View
    {
        $activities = Activity::onlyTrashed()
            ->with('category')
            ->orderByDesc('deleted_at')
            ->paginate(10);

        return view('activities.trash', compact('activities'));
    }

    public function restore(int $activity): RedirectResponse
    {
        $activity = Activity::onlyTrashed()->findOrFail($activity);
        $activity->restore();

        return redirect()->route('activities.trash')->with('success', 'Kegiatan berhasil dipulihkan.');
    }

    public function publish(Activity $activity, ActivityService $service): RedirectResponse
    {
        return $this->transition($activity, $service, 'publish');
    }

    public function complete(Activity $activity, ActivityService $service): RedirectResponse
    {
        return $this->transition($activity, $service, 'complete');
    }

    private function transition(Activity $activity, ActivityService $service, string $action): RedirectResponse
    {
        try {
            $service->{$action}($activity);
        } catch (DomainException $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('success', 'Status kegiatan berhasil diperbarui.');
    }
}
