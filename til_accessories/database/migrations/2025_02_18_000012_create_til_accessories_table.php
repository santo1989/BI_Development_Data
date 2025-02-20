<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('til_accessories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('WO_No');
            $table->string('Approved_Date')->nullable();
            $table->string('Internal_Ref_No')->nullable();
            $table->date('WO_Date');
            $table->date('Delivery_Date')->nullable();
            $table->string('WO_Type')->nullable();
            $table->string('Supplier')->nullable();
            $table->string('Buyer')->nullable();
            $table->year('Job_Year')->nullable();
            $table->string('Job_No')->nullable();
            $table->string('Style_Ref')->nullable();
            $table->string('Order_No')->nullable();
            $table->string('Order_qty')->nullable();
            $table->string('Item_Name')->nullable();
            $table->text('Description')->nullable();
            $table->string('UOM')->nullable();
            $table->integer('WO_Qty')->nullable();
            $table->float('WO_Unit_price')->nullable();
            $table->float('WO_value')->nullable();
            $table->float('Budget_Unit_price')->nullable();
            $table->float('Precost_value')->nullable();
            $table->float('Deference')->nullable();
            $table->float('Deference_percent')->nullable();
            $table->integer('On_Time_Receive')->nullable();
            $table->integer('OTD_percent')->nullable();
            $table->integer('Total_Receive_Qty')->nullable();
            $table->float('Receive_Value')->nullable();
            $table->float('Receive_Balance')->nullable();
            $table->string('Dealing_Merchant')->nullable();
            $table->string('Team_Leader')->nullable();
            $table->unsignedBigInteger('buyer_id');
            $table->string('User_Name')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->text('Remarks')->nullable();
            $table->unsignedBigInteger('item_umo_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('til_accessories');
    }
};
