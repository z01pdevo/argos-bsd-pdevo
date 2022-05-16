<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answer_id');
            $table->text('text')->nullable();
            $table->timestamp('compromise_at')->nullable();
            $table->boolean('done')->default(FALSE);
            $table->integer('done_by_id')->nullable();
            $table->string('importance', 10)->default('low');
            $table->string('who')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_plans');
    }
}
