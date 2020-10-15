<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('mobile', 255)->nullable();
            $table->string('user_uuid', 255)->nullable();
            $table->string('bill_id', 255)->nullable();
            $table->string('collection_id', 255)->nullable();
            $table->boolean('paid')->nullable();
            $table->datetime('paid_at')->nullable();
            $table->string('state', 255)->nullable();
            $table->integer('amount')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->date('due_at')->nullable();
            $table->string('url')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('callback_url')->nullable();
            $table->string('description')->nullable();
            $table->string('reference_1_label')->nullable();
            $table->string('reference_2_label')->nullable();
            $table->string('reference_1')->nullable();
            $table->string('reference_2')->nullable();
            $table->string('x_signature')->nullable();
            $table->boolean('is_production')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
