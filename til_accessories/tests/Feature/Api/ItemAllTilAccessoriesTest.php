<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\TilAccessories;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemAllTilAccessoriesTest extends TestCase
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
    public function it_gets_item_all_til_accessories(): void
    {
        $item = Item::factory()->create();
        $allTilAccessories = TilAccessories::factory()
            ->count(2)
            ->create([
                'item_id' => $item->id,
            ]);

        $response = $this->getJson(
            route('api.items.all-til-accessories.index', $item)
        );

        $response->assertOk()->assertSee($allTilAccessories[0]->WO_No);
    }

    /**
     * @test
     */
    public function it_stores_the_item_all_til_accessories(): void
    {
        $item = Item::factory()->create();
        $data = TilAccessories::factory()
            ->make([
                'item_id' => $item->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.items.all-til-accessories.store', $item),
            $data
        );

        $this->assertDatabaseHas('til_accessories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $tilAccessories = TilAccessories::latest('id')->first();

        $this->assertEquals($item->id, $tilAccessories->item_id);
    }
}
