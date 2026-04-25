<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Dog;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Dog::class, 'dog_id')->nullable()->constrained()->nullOnDelete();
            $table->tinyInteger('status')->default(0);
            $table->datetime('scheduled_at');
            $table->text('notes')->nullable();
            $table->text('treatment')->nullable();
            $table->decimal('amount')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
