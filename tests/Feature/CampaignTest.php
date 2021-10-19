<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Campaign;
use App\Models\CampaignImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CampaignTest extends TestCase
{
    public function test_a_user_can_view_all_his_campaigns()
    {
        $this->login();

        $response = $this->get(route('campaign.index'));

        $response->assertInertia(fn ($assert) => $assert->component('Campaign/Index'))
            ->assertOk();
    }

    public function test_a_guest_can_not_view_campaign_page()
    {
        $response = $this->get(route('campaign.index'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_a_user_can_view_create_campaign_page()
    {
        $this->login();

        $response = $this->get(route('campaign.create'));

        $response->assertInertia(fn ($assert) => $assert->component('Campaign/Create'))
            ->assertOk();
    }

    public function test_a_user_can_edit_a_valid_campaign_page()
    {
        $user = $this->login();
        $campaign = Campaign::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('campaign.edit', $campaign->code));

        $response->assertInertia(fn ($assert) => $assert->component('Campaign/Edit'))
            ->assertOk();
    }

    public function test_a_user_can_not_edit_another_users_campaign()
    {
        $this->login();
        $campaign = Campaign::factory()->create();

        $response = $this->get(route('campaign.edit', $campaign->code));

        $response->assertRedirect(route('campaign.index'))
            ->assertSessionHas('error', __('constants.unauthorized'));
    }

    public function test_a_user_can_edit_an_invalid_campaign_page()
    {
        $this->login();

        $response = $this->get(route('campaign.edit', $this->faker->uuid));

        $response->assertStatus(404);
    }

    public function test_a_user_can_update_a_campaign_page()
    {
        $user = $this->login();
        $payload = $this->payload();
        $campaign = Campaign::factory()->create(['user_id' => $user->id]);

        $response = $this->patch(route('campaign.update', $campaign->code), $payload);

        $response->assertRedirect(route('campaign.index'))
            ->assertSessionHas('success', 'Campaign updated successfully.');

        $this->assertDatabaseHas('campaigns', [
            'name' => $payload['name'],
            'daily_budget' => $payload['daily_budget'],
            'total_budget' => $payload['total_budget'],
            'user_id' => $user->id,
        ]);
    }

    public function test_a_user_can_create_a_campaign()
    {
        $user = $this->login();
        $payload = $this->payload();

        $response = $this->post(route('campaign.store'), $payload);

        $response->assertRedirect(route('campaign.index'))
            ->assertSessionHas('success', 'Campaign created successfully.');

        $this->assertDatabaseHas('campaigns', [
            'name' => $payload['name'],
            'daily_budget' => $payload['daily_budget'],
            'total_budget' => $payload['total_budget'],
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseCount('campaign_images', 2);
    }

    public function test_a_user_can_delete_a_campaign_image()
    {
        $user = $this->login();
        $campaign = Campaign::factory()->create(['user_id' => $user->id]);
        $image = CampaignImage::factory()->create(['campaign_id' => $campaign->id]);

        $response = $this->delete(route('campaign.image.delete', ['image' => $image->id]));

        $response->assertRedirect()
            ->assertSessionHas('success', 'Image removed successfully.');

        $this->assertDatabaseMissing('campaign_images', [
            'title' => $image->title,
            'id' => $image->id
        ]);
    }

    public function test_a_user_can_not_delete_a_campaign_image_of_another_user()
    {
        $user = $this->login();
        $image = CampaignImage::factory()->create();

        $response = $this->delete(route('campaign.image.delete', ['image' => $image->id]));

        $response->assertRedirect()
            ->assertSessionHas('error', __('constants.unauthorized'));
    }


    private function payload(): array
    {
        Storage::fake('photos');

        $files = [
            UploadedFile::fake()->image('photo1.jpg', 1000, 1000)->size(100),
            UploadedFile::fake()->image('photo2.jpg', 1000, 1000)->size(100),
        ];

        return [
            'name' => $this->faker->name,
            'daily_budget' => random_int(100, 100000),
            'total_budget' => random_int(100000, 1000000),
            'start_date' => now()->addDays(random_int(1, 30)),
            'end_date' => now()->addDays(random_int(30, 60)),
            'images' => $files,
        ];
    }
}
