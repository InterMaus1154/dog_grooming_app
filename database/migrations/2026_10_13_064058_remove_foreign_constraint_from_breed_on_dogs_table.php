<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dogs', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->unsignedBigInteger('customer_id')->nullable()->change();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->dropForeign(['dog_breed_id']);
            $table->unsignedBigInteger('dog_breed_id')->nullable()->change();
            $table->foreign('dog_breed_id')->references('id')->on('dog_breeds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dogs', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->unsignedBigInteger('dog_breed_id')->nullable(false)->change();
            $table->foreign('dog_breed_id')->references('id')->on('dog_breeds')->onDelete('cascade');
        });
    }
};
