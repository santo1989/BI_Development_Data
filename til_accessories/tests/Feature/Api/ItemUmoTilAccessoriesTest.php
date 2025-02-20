<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ItemUmo;
use App\Models\TilAccessories;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemUmoTilAccessoriesTest extends TestCase
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
    public function it_gets_item_umo_til_accessories(): void
    {
        $itemUmo = ItemUmo::factory()->create();
        $tilAccessories = TilAccessories::factory()
            ->count(2)
            ->create([
                'item_umo_id' => $itemUmo->id,
            ]);

        $response = $this->getJson(
            route('api.item-umos.til-accessories.index', $itemUmo)
        );

        $response->assertOk()->assertSee($tilAccessories[0]->WO_No);
    }

    /**
     * @test
     */
    public function it_stores_the_item_umo_til_accessories(): void
    {
        $itemUmo = ItemUmo::factory()->create();
        $data = TilAccessories::factory()
            ->make([
                'item_umo_id' => $itemUmo->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.item-umos.til-accessories.store', $itemUmo),
            $data
        );

        $this->assertDatabaseHas('til_accessories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $tilAccessories = TilAccessories::latest('id')->first();

        $this->assertEquals($itemUmo->id, $tilAccessories->item_umo_id);
    }
}
