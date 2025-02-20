<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ItemUmo;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemUmoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_item_umos(): void
    {
        $itemUmos = ItemUmo::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('item-umos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.item_umos.index')
            ->assertViewHas('itemUmos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_item_umo(): void
    {
        $response = $this->get(route('item-umos.create'));

        $response->assertOk()->assertViewIs('app.item_umos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_item_umo(): void
    {
        $data = ItemUmo::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('item-umos.store'), $data);

        $this->assertDatabaseHas('item_umos', $data);

        $itemUmo = ItemUmo::latest('id')->first();

        $response->assertRedirect(route('item-umos.edit', $itemUmo));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_item_umo(): void
    {
        $itemUmo = ItemUmo::factory()->create();

        $response = $this->get(route('item-umos.show', $itemUmo));

        $response
            ->assertOk()
            ->assertViewIs('app.item_umos.show')
            ->assertViewHas('itemUmo');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_item_umo(): void
    {
        $itemUmo = ItemUmo::factory()->create();

        $response = $this->get(route('item-umos.edit', $itemUmo));

        $response
            ->assertOk()
            ->assertViewIs('app.item_umos.edit')
            ->assertViewHas('itemUmo');
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

        $response = $this->put(route('item-umos.update', $itemUmo), $data);

        $data['id'] = $itemUmo->id;

        $this->assertDatabaseHas('item_umos', $data);

        $response->assertRedirect(route('item-umos.edit', $itemUmo));
    }

    /**
     * @test
     */
    public function it_deletes_the_item_umo(): void
    {
        $itemUmo = ItemUmo::factory()->create();

        $response = $this->delete(route('item-umos.destroy', $itemUmo));

        $response->assertRedirect(route('item-umos.index'));

        $this->assertModelMissing($itemUmo);
    }
}
