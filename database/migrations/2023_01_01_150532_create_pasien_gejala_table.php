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
    public function up()
    {
        Schema::create('pasien_gejala', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('gejala_id')->index();
            $table->uuid('check_in_id')->index();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('check_in_id')->references('id')->on('check_in');
            $table->foreign('gejala_id')->references('id')->on('gejala');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien_gejala');
    }
};
