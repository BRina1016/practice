<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            if (!Schema::hasColumn('reservations', 'zoho_deal_id')) {
                $table->string('zoho_deal_id')->nullable()->after('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            if (Schema::hasColumn('reservations', 'zoho_deal_id')) {
                $table->dropColumn('zoho_deal_id');
            }
        });
    }
};