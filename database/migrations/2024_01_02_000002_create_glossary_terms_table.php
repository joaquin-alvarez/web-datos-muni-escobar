<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('glossary_terms', function (Blueprint $table) {
            $table->id();
            $table->string('term');
            $table->string('slug')->unique();
            $table->text('definition');
            $table->string('letter', 1)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('glossary_terms');
    }
};
