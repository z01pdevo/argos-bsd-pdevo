<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('site');
            $table->string('type');
            $table->string('name');
            $table->string('manager_email');
            $table->string('exploitation_email')->nullable();
            $table->string('regional_name');
            $table->string('regional_email');
            $table->date('opened_at');
            $table->integer('sell_area');
            $table->foreignId('store_estate_type_id');
            $table->foreignId('store_location_type_id');
            $table->boolean('has_generator');
            $table->boolean('has_pumping');
            $table->boolean('active');
            $table->timestamp('deactivated_at')->nullable();
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
        Schema::dropIfExists('sites');
    }
}
