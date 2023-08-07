<?php

use App\Models\Materiels;
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
        Schema::create('stock_materiels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Materiels::class)->constrained()
                ->onDelete('CASCADE');
            $table->integer('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_materiels');
    }
};
