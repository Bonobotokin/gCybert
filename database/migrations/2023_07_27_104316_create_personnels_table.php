<?php

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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->boolean('sexe_personneles');
            $table->integer('age');
            $table->double('salaire_base', 10, 2)->default(0.00);
            $table->integer('telephone')->nullable();
            $table->string('adresse');
            $table->integer('cin')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()
                ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
