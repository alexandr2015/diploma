<?php

use App\Models\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create([
            'name' => 'student',
            'display_name' => 'Student',
            'description' => '',
        ]);

        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => '',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
