<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ItemUmo;
use App\Models\TilAccessories;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemUmoAllTilAccessoriesTest extends TestCase
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
    public function it_gets_item_umo_all_til_accessories(): void
    {
        $itemUmo = ItemUmo::factory()->create();
        $allTilAccessories = TilAccessories::factory()
            ->count(2)
            ->create([
                'itemUmo_id' => $itemUmo->id,
            ]);

        $response = $this->getJson(
            route('api.item-umos.all-til-accessories.index', $itemUmo)
        );

        $response->assertOk()->assertSee($allTilAccessories[0]->WO_No);
    }

    /**
     * @test
     */
    public function it_stores_the_item_umo_all_til_accessories(): void
    {
        $itemUmo = ItemUmo::factory()->create();
        $data = TilAccessories::factory()
            ->make([
                'itemUmo_id' => $itemUmo->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.item-umos.all-til-accessories.store', $itemUmo),
            $data
        );

        $this->assertDatabaseHas('til_accessories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $tilAccessories = TilAccessories::latest('id')->first();

        $this->assertEquals($itemUmo->id, $tilAccessories->itemUmo_id);
    }
}
