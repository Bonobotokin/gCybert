<?php

use App\Models\facture;
// use App\Models\Materiels;
// use App\Models\Personnel;
// use App\Models\Service;
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
        Schema::create('encaissements', function (Blueprint $table) {
            $table->id();
            $table->string('facture_id')->nullable();
            $table->string('description')->nullable();
            // $table->integer('description_reste')->nullable();
            // $table->foreignIdFor(Service::class)->nullable()->constrained();
            // // $table->foreignIdFor(Materiels::class)->nullable()->constrained();
            // $table->integer('quantite')->nullable();
            $table->double('montant', 10,2)->default(0.00);
            $table->double('payer', 10,2)->default(0.00);
            $table->double('reste', 10,2)->default(0.00);
            $table->foreignIdFor(User::class)->constrained();
            $table->date('date')->nullable();
            // $table->string('client')->nullable();
            $table->integer('ispayed')->default(false);
            // $table->foreignIdFor(Personnel::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encaissements');
    }
};
