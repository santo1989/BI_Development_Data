<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Buyer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuyerTest extends TestCase
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
    public function it_gets_buyers_list(): void
    {
        $buyers = Buyer::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.buyers.index'));

        $response->assertOk()->assertSee($buyers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_buyer(): void
    {
        $data = Buyer::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.buyers.store'), $data);

        $this->assertDatabaseHas('buyers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_buyer(): void
    {
        $buyer = Buyer::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('api.buyers.update', $buyer), $data);

        $data['id'] = $buyer->id;

        $this->assertDatabaseHas('buyers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_buyer(): void
    {
        $buyer = Buyer::factory()->create();

        $response = $this->deleteJson(route('api.buyers.destroy', $buyer));

        $this->assertSoftDeleted($buyer);

        $response->assertNoContent();
    }
}
