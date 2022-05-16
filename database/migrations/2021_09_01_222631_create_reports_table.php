<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('score')->default(0);
            $table->integer('max_score')->default(0);
            $table->foreignId('site_id');
            $table->foreignId('user_id');
            $table->foreignId('alert_level_id')->nullable();
            $table->integer('to_dda')->nullable();
            $table->float('to_progression', 8,2)->nullable();
            $table->float('rbe_dda')->nullable();
            $table->float('mrbe_dda')->nullable();
            $table->float('demarque_dda', 5,2)->nullable();
            $table->integer('quantity_workers')->nullable();
            $table->integer('weekly_hours')->nullable();
            $table->integer('share_exploitation')->nullable();
            $table->boolean('is_finished')->default(false);
            $table->boolean('has_actionplans')->default(false);
            $table->time('time_active')->nullable();
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
