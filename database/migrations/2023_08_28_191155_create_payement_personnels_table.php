<?php

use App\Models\Personnel;
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
        Schema::create('payement_personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Personnel::class)->constrained()
            ->onDelete('CASCADE');
            $table->double('payement', 10,2)->default(0);
            $table->double('reste', 10,2)->default(0);
            $table->string('observation');
            $table->integer('etat')->default(0);
            $table->foreignIdFor(User::class)->constrained()
            ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payement_personnels');
    }
};

