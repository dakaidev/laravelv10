<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_number')->unique();
            $table->foreignId('document_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('office_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('sender');
            $table->string('recipient');
            $table->string('subject');
            $table->date('date');
            $table->date('received_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
