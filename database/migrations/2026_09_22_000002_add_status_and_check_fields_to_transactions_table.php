<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndCheckFieldsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'status')) {
                $table->string('status', 20)->default('completed');
            }
            if (!Schema::hasColumn('transactions', 'clearing_date')) {
                $table->date('clearing_date')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'deposit_method')) {
                $table->string('deposit_method', 50)->nullable()->default('wire');
            }
            if (!Schema::hasColumn('transactions', 'check_front_image')) {
                $table->string('check_front_image')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'check_back_image')) {
                $table->string('check_back_image')->nullable();
            }
            if (!Schema::hasColumn('transactions', 'check_number')) {
                $table->string('check_number', 50)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $columns = ['status', 'clearing_date', 'deposit_method', 'check_front_image', 'check_back_image', 'check_number'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('transactions', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
