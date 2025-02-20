<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_items_list(): void
    {
        $items = Item::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.items.index'));

        $response->assertOk()->assertSee($items[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_item(): void
    {
        $data = Item::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.items.store'), $data);

        $this->assertDatabaseHas('items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_item(): void
    {
        $item = Item::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('api.items.update', $item), $data);

        $data['id'] = $item->id;

        $this->assertDatabaseHas('items', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_item(): void
    {
        $item = Item::factory()->create();

        $response = $this->deleteJson(route('api.items.destroy', $item));

        $this->assertSoftDeleted($item);

        $response->assertNoContent();
    }
}
