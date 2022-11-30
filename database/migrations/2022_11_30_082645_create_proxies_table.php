<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('proxies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->index();
            $table->ipAddress('ip')->index();
            $table->integer('port');
            $table->string('login')->index();
            $table->string('password');
            $table->timestamps();

            $table
                ->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('proxies');
    }
};
