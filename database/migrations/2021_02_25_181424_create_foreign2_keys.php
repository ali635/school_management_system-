<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeign2Keys extends Migration {

	public function up()
	{
        Schema::table('my__parents', function(Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');
        });


	}

	public function down()
	{
		
        Schema::table('my__parents', function(Blueprint $table) {
            $table->dropForeign('my__parents_Nationality_Father_id_foreign');
        });
        Schema::table('my__parents', function(Blueprint $table) {
            $table->dropForeign('my__parents_Blood_Type_Father_id_foreign');
        });
        Schema::table('my__parents', function(Blueprint $table) {
            $table->dropForeign('my__parents_Religion_Father_id_foreign');
        });
        Schema::table('my__parents', function(Blueprint $table) {
            $table->dropForeign('my__parents_Nationality_Mother_id_foreign');
        });
        Schema::table('my__parents', function(Blueprint $table) {
            $table->dropForeign('my__parents_Blood_Type_Mother_id_foreign');
        });
        Schema::table('my__parents', function(Blueprint $table) {
            $table->dropForeign('my__parents_Religion_Mother_id_foreign');
        });
	}
}