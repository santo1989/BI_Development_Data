<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TilAccessories;
use Illuminate\Database\Eloquent\Factories\Factory;

class TilAccessoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TilAccessories::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
            'buyer_id' => \App\Models\Buyer::factory(),
            'item_id' => \App\Models\Item::factory(),
            'item_umo_id' => \App\Models\ItemUmo::factory(),
        ];
    }
}
