<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ItemUmo;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemUmoTest extends TestCase
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
    public function it_gets_item_umos_list(): void
    {
        $itemUmos = ItemUmo::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.item-umos.index'));

        $response->assertOk()->assertSee($itemUmos[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_item_umo(): void
    {
        $data = ItemUmo::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.item-umos.store'), $data);

        $this->assertDatabaseHas('item_umos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_item_umo(): void
    {
        $itemUmo = ItemUmo::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.item-umos.update', $itemUmo),
            $data
        );

        $data['id'] = $itemUmo->id;

        $this->assertDatabaseHas('item_umos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_item_umo(): void
    {
        $itemUmo = ItemUmo::factory()->create();

        $response = $this->deleteJson(route('api.item-umos.destroy', $itemUmo));

        $this->assertModelMissing($itemUmo);

        $response->assertNoContent();
    }
}
