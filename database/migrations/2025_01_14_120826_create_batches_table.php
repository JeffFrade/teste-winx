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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_company')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->char('status', 1)
                ->default('C')
                ->comment('C => Created | R => Running | F => Finished (100% Ok) | W => Finished With Errors (Warning) | X => Error');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_company')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
