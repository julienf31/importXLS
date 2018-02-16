<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('slc_number');
            $table->string('slc_name');
            $table->string('date_time');
            $table->string('lamp_status');
            $table->string('photocell_status');
            $table->string('voltage_under_over');
            $table->string('lamp');
            $table->string('photocell_oscillatin');
            $table->string('photocell_feedback');
            $table->string('lamp_cyclic');
            $table->string('communication');
            $table->string('ballast');
            $table->string('abnormal_lamp_condit');
            $table->string('rtc_status');
            $table->string('event_over_flow');
            $table->string('em_fault');
            $table->string('relay_weld');
            $table->string('dimming_short');
            $table->string('day_burning');
            $table->string('pole_fault');
            $table->string('photocell_fault');
            $table->string('controller_fault');
            $table->string('voltage');
            $table->string('current');
            $table->string('kilowatt');
            $table->string('cum_kwh');
            $table->string('burn_hrs');
            $table->string('dimming');
            $table->string('power_factor');
            $table->string('lamp_steady_current');
            $table->string('mode');
            $table->string('temperature');
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
        Schema::drop('datas');
    }

}
