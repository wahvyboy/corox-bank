<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EnhanceAccountsAndUserLoginTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Add IP and Timezone columns to users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'last_login_ip')) {
                $table->string('last_login_ip', 45)->nullable()->after('last_login_at');
            }
            if (!Schema::hasColumn('users', 'last_login_timezone')) {
                $table->string('last_login_timezone', 64)->nullable()->after('last_login_ip');
            }
        });

        // 2. Safely support Investment account type on MySQL and SQLite
        try {
            $driver = DB::connection()->getDriverName();
            if ($driver === 'mysql') {
                DB::statement("ALTER TABLE accounts MODIFY COLUMN account_type VARCHAR(50) NOT NULL DEFAULT 'Checking'");
            } elseif ($driver === 'sqlite') {
                DB::statement("PRAGMA foreign_keys = OFF;");
                DB::statement("CREATE TABLE IF NOT EXISTS accounts_temp (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    account_number VARCHAR(10) NOT NULL UNIQUE,
                    routing_number VARCHAR(9) NOT NULL DEFAULT '071923456',
                    account_type VARCHAR(50) NOT NULL DEFAULT 'Checking',
                    balance NUMERIC(12, 2) NOT NULL DEFAULT 0.00,
                    currency VARCHAR(3) NOT NULL DEFAULT 'USD',
                    user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
                    status VARCHAR(20) NOT NULL DEFAULT 'pending',
                    created_at DATETIME,
                    updated_at DATETIME
                );");
                DB::statement("INSERT OR IGNORE INTO accounts_temp (id, account_number, routing_number, account_type, balance, currency, user_id, status, created_at, updated_at)
                               SELECT id, account_number, routing_number, account_type, balance, currency, user_id, status, created_at, updated_at FROM accounts;");
                DB::statement("DROP TABLE accounts;");
                DB::statement("ALTER TABLE accounts_temp RENAME TO accounts;");
                DB::statement("PRAGMA foreign_keys = ON;");
            }
        } catch (\Throwable $e) {
            // Log or ignore if table is already rebuilt
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            if (Schema::hasColumn('users', 'last_login_timezone')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('last_login_timezone');
                });
            }
            if (Schema::hasColumn('users', 'last_login_ip')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('last_login_ip');
                });
            }
        } catch (\Throwable $e) {
            // Ignore rollback errors in SQLite
        }
    }
}
