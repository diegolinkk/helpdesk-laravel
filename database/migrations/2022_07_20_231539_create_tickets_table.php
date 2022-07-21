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
        Schema::create('tickets', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->string('name',255);
            $table->string('description');
            $table->boolean('finished')->default(false);
            $table->date('finished_date')->nullable();

            //foreign keys
            $table->foreignId('ticket_type_id')
            ->constrained()
            ->nullOnDelete();
            
            $table->foreignId('category_id')
            ->constrained()
            ->nullOnDelete();

            $table->foreignId('team_id')
            ->constrained()
            ->onDelete('cascade');

            $table->integer('finished_by_user')->nullable();
            $table->foreign('finished_by_user')
            ->references('id')
            ->on('users')
            ->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
