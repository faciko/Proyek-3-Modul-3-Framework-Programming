<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvancedActivityFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_applies_search_category_status_and_sort_filters(): void
    {
        $technology = Category::create(['name' => 'Teknologi', 'slug' => 'teknologi']);
        $sports = Category::create(['name' => 'Olahraga', 'slug' => 'olahraga']);
        $matching = $this->createActivity($technology, ['code' => 'WEB-101', 'title' => 'Workshop Web', 'status' => 'published']);
        $this->createActivity($sports, ['code' => 'SPT-101', 'title' => 'Turnamen Futsal', 'status' => 'published']);

        $response = $this->get(route('activities.index', [
            'search' => 'web',
            'category_id' => $technology->id,
            'status' => 'published',
            'sort' => 'latest',
        ]));

        $response->assertSee($matching->title);
        $response->assertDontSee('Turnamen Futsal');
    }

    public function test_publish_and_complete_follow_the_allowed_transition(): void
    {
        $activity = $this->createActivity($this->createCategory());

        $this->patch(route('activities.publish', $activity))->assertSessionHas('success');
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'status' => 'published']);

        $this->patch(route('activities.complete', $activity))->assertSessionHas('success');
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'status' => 'completed']);

        $this->patch(route('activities.publish', $activity))->assertSessionHas('error');
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'status' => 'completed']);
    }

    public function test_destroy_soft_deletes_and_restore_returns_activity_to_active_list(): void
    {
        $activity = $this->createActivity($this->createCategory());

        $this->delete(route('activities.destroy', $activity))->assertRedirect(route('activities.index'));
        $this->assertSoftDeleted('activities', ['id' => $activity->id]);

        $this->patch(route('activities.restore', $activity->id))->assertRedirect(route('activities.trash'));
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'deleted_at' => null]);
    }

    public function test_registration_rejects_duplicate_email_without_incrementing_count_twice(): void
    {
        $activity = $this->createActivity($this->createCategory(), ['status' => 'published']);
        $payload = ['participant_name' => 'Faiq', 'email' => 'faiq@example.test'];

        $this->post(route('activities.registrations.store', $activity), $payload)->assertSessionHas('success');
        $this->assertDatabaseHas('registrations', ['activity_id' => $activity->id, 'email' => $payload['email']]);
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'registered_count' => 1]);

        $this->post(route('activities.registrations.store', $activity), $payload)->assertSessionHasErrors('registration');
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'registered_count' => 1]);
    }

    private function createCategory(): Category
    {
        return Category::create(['name' => 'Akademik', 'slug' => 'akademik']);
    }

    /** @param array<string, mixed> $attributes */
    private function createActivity(Category $category, array $attributes = []): Activity
    {
        return Activity::create(array_merge([
            'category_id' => $category->id,
            'code' => 'ACT-'.fake()->unique()->numberBetween(100, 999),
            'title' => 'Kegiatan Pengujian',
            'description' => 'Deskripsi kegiatan pengujian.',
            'start_at' => now()->addWeek(),
            'end_at' => now()->addWeek()->addHours(2),
            'location' => 'Laboratorium',
            'capacity' => 20,
            'status' => 'draft',
        ], $attributes));
    }
}
