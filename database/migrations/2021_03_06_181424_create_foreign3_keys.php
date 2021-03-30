<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeign3Keys extends Migration {

	public function up()
	{
        Schema::table('parent_attachments', function(Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('my__parents')->onDelete('cascade');
        });


	}

	public function down()
	{
		
        Schema::table('parent_attachments', function(Blueprint $table) {
            $table->dropForeign('parent_attachments_parent_id_foreign');
        });
	}
}