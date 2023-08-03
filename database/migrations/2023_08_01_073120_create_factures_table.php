<?php

use App\Models\Personnel;
use App\Models\Service;
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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->foreignIdFor(Service::class)->nullable()->constrained();
            $table->integer('quantite')->nullable();
            $table->double('montant', 10,2)->default(0.00);
            $table->date('date')->nullable();
            $table->string('client')->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Personnel::class)->nullable()->constrained();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
