<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('duration_months');
            $table->text('features');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Add plan_id to subscriptions table
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->foreignId('plan_id')->nullable()->after('user_id')
                ->constrained('subscription_plans')->nullOnDelete();
        });
        
        // Add transaction_id and notes to payments table
        Schema::table('payments', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('status');
            $table->text('notes')->nullable()->after('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove foreign key and column from subscriptions table
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn('plan_id');
        });
        
        // Remove columns from payments table
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['transaction_id', 'notes']);
        });
        
        Schema::dropIfExists('subscription_plans');
    }
}