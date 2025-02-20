<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Buyer;
use App\Models\TilAccessories;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuyerTilAccessoriesTest extends TestCase
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
    public function it_gets_buyer_til_accessories(): void
    {
        $buyer = Buyer::factory()->create();
        $tilAccessories = TilAccessories::factory()
            ->count(2)
            ->create([
                'buyer_id' => $buyer->id,
            ]);

        $response = $this->getJson(
            route('api.buyers.til-accessories.index', $buyer)
        );

        $response->assertOk()->assertSee($tilAccessories[0]->WO_No);
    }

    /**
     * @test
     */
    public function it_stores_the_buyer_til_accessories(): void
    {
        $buyer = Buyer::factory()->create();
        $data = TilAccessories::factory()
            ->make([
                'buyer_id' => $buyer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.buyers.til-accessories.store', $buyer),
            $data
        );

        $this->assertDatabaseHas('til_accessories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $tilAccessories = TilAccessories::latest('id')->first();

        $this->assertEquals($buyer->id, $tilAccessories->buyer_id);
    }
}
