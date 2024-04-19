<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('promotion')->nullable();
            $table->string('review')->nullable();
            $table->string('price'); 
            $table->string('starnumber'); 
            $table->unsignedBigInteger('category_hotel_id');
            $table->foreign('category_hotel_id')
                  ->references('id')
                  ->on('category_hotels')
                  ->onDelete('cascade');
            // Add region_id column and foreign key
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')
                  ->references('id')
                  ->on('regions')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};