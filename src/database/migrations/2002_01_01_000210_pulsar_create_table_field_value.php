<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableFieldValue extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('field_value'))
        {
            Schema::create('field_value', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->string('id', 30);
                // counter to assign number to id if has not ID
                $table->integer('counter')->unsigned()->nullable();

                $table->string('lang_id', 2);
                $table->integer('field_id')->unsigned();
                $table->string('name');
                $table->smallInteger('sort')->unsigned()->nullable();
                $table->boolean('featured');
                $table->json('data_lang')->nullable();
                $table->json('data')->nullable();

                $table->timestamps();
                $table->softDeletes();
                
                $table->foreign('lang_id', 'fk01_field_value')
                    ->references('id')
                    ->on('lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('field_id', 'fk02_field_value')
                    ->references('id')
                    ->on('field')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->primary(['id', 'lang_id', 'field_id'], 'pk01_field_value');
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
        Schema::dropIfExists('field_value');
    }
}
