<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamuEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samu_events', function (Blueprint $table) {
            $table->id();
            
            $table->date('date');
            $table->integer('counter');
       
            /* llaves foraneas */
            $table->foreignId('shift_id')->constrained('samu_shifts');
            $table->foreignId('key_id')->nullable()->constrained('samu_keys');
            $table->foreignId('return_key_id')->nullable()->constrained('samu_keys');
            $table->foreignId('mobile_in_service_id')->nullable()->constrained('samu_mobiles_in_service');
            $table->foreignId('mobile_id')->nullable()->constrained('samu_mobiles');
            $table->text('external_crew')->nullable();

            $table->text('observation')->nullable();

            $table->datetime('departure_at')->nullable();
            $table->datetime('mobile_departure_at')->nullable();
            $table->datetime('mobile_arrival_at')->nullable();
            $table->datetime('route_to_healtcenter_at')->nullable();
            $table->datetime('healthcenter_at')->nullable();
            $table->datetime('patient_reception_at')->nullable();
            $table->datetime('return_base_at')->nullable();
            $table->datetime('on_base_at')->nullable();
            
            $table->string('address')->nullable();
            $table->foreignId('commune_id')->nullable()->constrained('communes');
            

            /* Paciente */
            $table->boolean('patient_unknown')->nullable();
            $table->foreignId('patient_identifier_type_id')->nullable()->constrained('cod_con_identifier_types');
            $table->string('patient_identification')->nullable();
            $table->string('patient_name')->nullable();
            
            /* Recepción en centro asistencial */
            $table->text('reception_detail')->nullable();
            $table->foreignId('establishment_id')->nullable()->constrained('organizations');
            $table->string('reception_person')->nullable();
            $table->foreignId('reception_place_id')->nullable()->constrained('samu_reception_places');
            /* Registro atención de urgencia */
            $table->string('rau')->nullable();


            /* Asignacion signos vitales */
            $table->integer('fc')->nullable();
            $table->integer('fr')->nullable();
            $table->string('pa')->nullable();
            $table->string('pam')->nullable();
            $table->integer('gl')->nullable();
            $table->integer('soam')->nullable();
            $table->integer('soap')->nullable();
            $table->integer('hgt')->nullable();
            $table->integer('fill_capillary')->nullable();
            $table->integer('t')->nullable();
            
            $table->text('treatment')->nullable();
            $table->text('observation_sv')->nullable();

            $table->foreignId('creator_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('samu_call_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('call_id')->constrained('samu_calls');
            $table->foreignId('event_id')->constrained('samu_events');
        });

        Schema::create('samu_event_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('samu_events');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('job_type_id')->constrained('samu_job_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samu_event_user');
        Schema::dropIfExists('samu_call_event');
        Schema::dropIfExists('samu_events');
    }
}
