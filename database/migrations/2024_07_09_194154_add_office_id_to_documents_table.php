<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficeIdToDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'office_id')) {
                $table->unsignedBigInteger('office_id')->after('id');
                $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'office_id')) {
                $table->dropForeign(['office_id']);
                $table->dropColumn('office_id');
            }
        });
    }
}
