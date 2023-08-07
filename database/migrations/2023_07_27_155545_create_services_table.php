<?php

use App\Models\Materiels;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->foreignIdFor(Materiels::class)
                ->nullable()
                ->constrained()
                ->onDelete('CASCADE');
            // $table->unsignedBigInteger('materiels_id_1')->nullable();
            // $table->foreign('materiels_id_1')
            //     ->references('id')->on('Materiels');
            // $table->unsignedBigInteger('materiels_id_2')->nullable();
            // $table->foreign('materiels_id_2')
            // ->references('id')->on('Materiels');
            $table->double('prix', 10, 2)->default(0.00);
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
        Schema::dropIfExists('services');
    }
};
