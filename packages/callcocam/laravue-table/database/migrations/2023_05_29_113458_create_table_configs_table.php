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
        Schema::create('table_configs', function (Blueprint $table) {
           $table->ulid('id')->primary();
           $table->foreignUlid('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete();
           $table->foreignUlid('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            //
            $table->enum('status', ['draft','published'])->default('published');
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
        Schema::dropIfExists('table_configs');
    }
};
