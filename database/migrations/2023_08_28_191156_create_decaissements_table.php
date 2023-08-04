<?php

use App\Models\Materiels;
use App\Models\PayementPersonnel;
use App\Models\User;
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
        Schema::create('decaissements', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignIdFor(Materiels::class)->nullable()->constrained();
            $table->foreignIdFor(PayementPersonnel::class)->nullable()->constrained();
            $table->integer('quantite')->default(0);
            $table->double('montant',10,2)->default(0.00);
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decaissements');
    }
};
