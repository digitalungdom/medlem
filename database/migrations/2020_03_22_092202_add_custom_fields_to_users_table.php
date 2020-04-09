<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('firstname');
            $table->string('lastname');
            $table->string('cellphone')->nullable()->unique();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female','other','unknown'])->default('unknown');
            $table->dateTime('self_verified_at')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->boolean('globaladmin')->nullable();
            $table->boolean('is_parent')->nullable();
            $table->bigInteger('parent')->nullable()->references('id')->on('users');
            $table->text('address')->nullable();
            $table->integer('postnumber')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('cellphone');
            #$table->dropColumn('birthday');
            #$table->dropColumn('gender');
            $table->dropColumn('self_verified_at');
            $table->dropColumn('last_login');
            $table->dropColumn('globaladmin');
            $table->dropColumn('is_parent');
            $table->dropColumn('parent');
        });
    }
}
