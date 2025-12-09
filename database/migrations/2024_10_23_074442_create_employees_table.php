<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key
            $table->string('firstname'); // First Name
            $table->string('lastname'); // Last Name
            $table->string('email')->unique(); // Email (unique)
            $table->string('phone')->nullable(); // Phone (nullable)
            $table->date('date_of_birth'); // Date of Birth
            $table->date('joining_date'); // Joining Date
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
