<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabelToPermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->addColumn('string','label' , ['length'=> 150])->after('name');
        });
        Schema::table($tableNames['roles'], function (Blueprint $table) {
            $table->addColumn('string','label', ['length'=> 150])->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }
        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->dropColumn('label');
        });
        Schema::table($tableNames['roles'], function (Blueprint $table) {
            $table->dropColumn('label');
        });
    }
}
