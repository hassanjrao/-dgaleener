<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateContactMessagesTableCopy extends Migration
{
    public function up()
    {
        DB::table('roles')->insert([
            ['name' => 'student/estudiante'],
            ['name' => 'practitioner/practicante'],
            ['name' => 'guest/invitado'],
        ]);
    }

    public function down()
    {
    }
}
