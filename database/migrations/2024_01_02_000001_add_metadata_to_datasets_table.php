<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('datasets', function (Blueprint $table) {
            $table->string('version')->default('1.0')->after('organization');
            $table->string('periodicity')->default('mensual')->after('version');
            $table->string('source')->nullable()->after('periodicity');
            $table->string('license')->default('Open Data Commons Open Database License (ODbL)')->after('source');
            $table->timestamp('created_date')->nullable()->after('license');
        });
    }

    public function down()
    {
        Schema::table('datasets', function (Blueprint $table) {
            $table->dropColumn(['version', 'periodicity', 'source', 'license', 'created_date']);
        });
    }
};
