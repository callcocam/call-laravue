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
        Schema::create('addresses', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete();
            $table->foreignUlid('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('state', 3)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('codigo', 50)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('number', 10)->nullable();
            $table->string('district', 255)->nullable();
            $table->string('latitude', 255)->nullable();
            $table->string('longetude', 255)->nullable();
            $table->string('complement', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->ulidMorphs('addressable');
            $table->enum('status', ['draft', 'published'])->default('published')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
