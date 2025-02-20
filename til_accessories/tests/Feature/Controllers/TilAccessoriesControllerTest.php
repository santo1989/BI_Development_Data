<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TilAccessories;

use App\Models\Item;
use App\Models\Buyer;
use App\Models\ItemUmo;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TilAccessoriesControllerTest extends TestCase
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
    public function it_displays_index_view_with_til_accessories(): void
    {
        $tilAccessories = TilAccessories::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('til-accessories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.til_accessories.index')
            ->assertViewHas('tilAccessories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_til_accessories(): void
    {
        $response = $this->get(route('til-accessories.create'));

        $response->assertOk()->assertViewIs('app.til_accessories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_til_accessories(): void
    {
        $data = TilAccessories::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('til-accessories.store'), $data);

        $this->assertDatabaseHas('til_accessories', $data);

        $tilAccessories = TilAccessories::latest('id')->first();

        $response->assertRedirect(
            route('til-accessories.edit', $tilAccessories)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_til_accessories(): void
    {
        $tilAccessories = TilAccessories::factory()->create();

        $response = $this->get(route('til-accessories.show', $tilAccessories));

        $response
            ->assertOk()
            ->assertViewIs('app.til_accessories.show')
            ->assertViewHas('tilAccessories');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_til_accessories(): void
    {
        $tilAccessories = TilAccessories::factory()->create();

        $response = $this->get(route('til-accessories.edit', $tilAccessories));

        $response
            ->assertOk()
            ->assertViewIs('app.til_accessories.edit')
            ->assertViewHas('tilAccessories');
    }

    /**
     * @test
     */
    public function it_updates_the_til_accessories(): void
    {
        $tilAccessories = TilAccessories::factory()->create();

        $buyer = Buyer::factory()->create();
        $item = Item::factory()->create();
        $itemUmo = ItemUmo::factory()->create();

        $data = [
            'WO_No' => $this->faker->text(255),
            'Approved_Date' => $this->faker->text(255),
            'Internal_Ref_No' => $this->faker->text(255),
            'WO_Date' => $this->faker->date(),
            'Delivery_Date' => $this->faker->date(),
            'WO_Type' => $this->faker->text(255),
            'Supplier' => $this->faker->text(255),
            'Buyer' => $this->faker->text(255),
            'Job_Year' => $this->faker->year(),
            'Job_No' => $this->faker->text(255),
            'Style_Ref' => $this->faker->text(255),
            'Order_No' => $this->faker->text(255),
            'Order_qty' => $this->faker->text(255),
            'Item_Name' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'UOM' => $this->faker->text(255),
            'WO_Qty' => $this->faker->randomNumber(0),
            'WO_Unit_price' => $this->faker->randomNumber(2),
            'WO_value' => $this->faker->randomNumber(2),
            'Budget_Unit_price' => $this->faker->randomNumber(2),
            'Precost_value' => $this->faker->randomNumber(2),
            'Deference' => $this->faker->randomNumber(2),
            'Deference_percent' => $this->faker->randomNumber(2),
            'On_Time_Receive' => $this->faker->randomNumber(0),
            'OTD_percent' => $this->faker->randomNumber(0),
            'Total_Receive_Qty' => $this->faker->randomNumber(0),
            'Receive_Value' => $this->faker->randomNumber(2),
            'Receive_Balance' => $this->faker->randomNumber(2),
            'Dealing_Merchant' => $this->faker->text(255),
            'Team_Leader' => $this->faker->text(255),
            'User_Name' => $this->faker->text(255),
            'Remarks' => $this->faker->text(),
            'buyer_id' => $buyer->id,
            'item_id' => $item->id,
            'item_umo_id' => $itemUmo->id,
        ];

        $response = $this->put(
            route('til-accessories.update', $tilAccessories),
            $data
        );

        $data['id'] = $tilAccessories->id;

        $this->assertDatabaseHas('til_accessories', $data);

        $response->assertRedirect(
            route('til-accessories.edit', $tilAccessories)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_til_accessories(): void
    {
        $tilAccessories = TilAccessories::factory()->create();

        $response = $this->delete(
            route('til-accessories.destroy', $tilAccessories)
        );

        $response->assertRedirect(route('til-accessories.index'));

        $this->assertSoftDeleted($tilAccessories);
    }
}
