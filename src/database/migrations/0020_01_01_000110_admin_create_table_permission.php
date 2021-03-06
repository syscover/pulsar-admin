<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTablePermission extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_permission'))
		{
			Schema::create('admin_permission', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->integer('profile_id')->unsigned();
				$table->string('resource_id', 30);
				$table->string('action_id', 25);

                $table->timestamps();
                $table->softDeletes();
				
				$table->primary(['profile_id', 'resource_id', 'action_id']);
				$table->foreign('profile_id', 'fk01_admin_permission')
					->references('id')
					->on('admin_profile')
					->onDelete('cascade')
					->onUpdate('cascade');
				$table->foreign('resource_id', 'fk02_admin_permission')
					->references('id')
					->on('admin_resource')
					->onDelete('cascade')
					->onUpdate('cascade');
				$table->foreign('action_id', 'fk03_admin_permission')
					->references('id')
					->on('admin_action')
					->onDelete('cascade')
					->onUpdate('cascade');

			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('admin_permission');
	}
}