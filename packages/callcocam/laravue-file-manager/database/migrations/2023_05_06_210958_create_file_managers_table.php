<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

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
        Schema::create('file_managers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete();
            $table->foreignUlid('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('name', 255);
            $table->string('slug', 255)->nullable();
            $table->string('path', 255)->nullable();
            $table->string('icon')->default('PhotoIcon')->nullable();
            $table->string('extension', 20)->nullable();
            $table->string('size', 20)->nullable();
            $table->string('mime_type', 100)->default('image/jpg')->nullable();
            $table->text('url')->nullable();
            $table->string('disk', 20)->default('public')->nullable();
            $table->date('recent')->nullable();
            $table->boolean('important')->default(false)->nullable();
            $table->boolean('shared')->default(false)->nullable();
            $table->integer('ordering')->nullable();
            $table->enum('type', ['dir', 'file'])->default('dir');
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('file_managers', function (Blueprint $table) {

            $table->foreignUlid('file_manager_id')->nullable()->constrained('file_managers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_managers');
    }
};
