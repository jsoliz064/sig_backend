<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('admin')->default(false); // field that manage if the user is admin
            $table->date('birthday')->nullable();
            $table->string('ci')->nullable();
            $table->string('email')->unique();
            $table->boolean('gender')->default(true); // man == true , woman == true
            $table->string('name');
            $table->string('phone')->nullable();
            $table->foreignId('license_category_id')->nullable()->constrained('license_categories');
            $table->foreignId('bus_id')->nullable()->constrained('buses');// admins will have a fk bus_id that shows what bus the admin manage
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
