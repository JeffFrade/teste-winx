<?php

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
        Schema::create('batch_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_batch')->unsigned();
            $table->integer('line');
            $table->text('line_content');
            $table->char('status')->comment('S => Success | F => Failure');
            $table->text('obs')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_batch')
                ->references('id')
                ->on('batches')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_infos');
    }
};
