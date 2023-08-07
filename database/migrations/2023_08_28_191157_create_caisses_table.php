<?php

use App\Models\Decaissement;
use App\Models\Encaissement;
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
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Encaissement::class)->nullable()->constrained()
                ->onDelete('CASCADE');
            $table->foreignIdFor(Decaissement::class)->nullable()->constrained()
                ->onDelete('CASCADE');
            $table->double('solde', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisses');
    }
};
