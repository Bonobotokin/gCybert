<?php

use App\Models\Encaissement;
use App\Models\facture;
use App\Models\Payement;
use App\Models\StockMateriels;
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
        Schema::create('etat_stock_materiels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StockMateriels::class)->constrained();
            $table->foreignIdFor(facture::class)->nullable()->constrained();
            $table->integer('quantite')->default(0);
            $table->string('observation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etat_stock_materiels');
    }
};
