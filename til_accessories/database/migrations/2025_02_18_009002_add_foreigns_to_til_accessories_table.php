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
        Schema::table('til_accessories', function (Blueprint $table) {
            $table
                ->foreign('buyer_id')
                ->references('id')
                ->on('buyers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('item_umo_id')
                ->references('id')
                ->on('item_umos')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('til_accessories', function (Blueprint $table) {
            $table->dropForeign(['buyer_id']);
            $table->dropForeign(['item_id']);
            $table->dropForeign(['item_umo_id']);
        });
    }
};
