<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableAttachmentFamily extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('admin_attachment_family'))
        {
            Schema::create('admin_attachment_family', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id');
                $table->string('resource_id', 30); // resource which belong to this attachment
                $table->string('name');
                $table->smallInteger('width')->unsigned()->nullable();
                $table->smallInteger('height')->unsigned()->nullable();
                $table->json('sizes')->nullable();
                $table->tinyInteger('quality')->unsigned()->default(90);
                $table->string('format', 10)->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('resource_id', 'fk01_admin_attachment_family')
                    ->references('object_id')
                    ->on('admin_resource')
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
        Schema::dropIfExists('admin_attachment_family');
    }
}
