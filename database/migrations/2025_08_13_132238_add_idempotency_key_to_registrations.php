<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $t) {
            $t->string('idempotency_key', 64)
                ->nullable()
                ->unique()
                ->after('note');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $t) {
            $t->dropUnique(['registrations_idempotency_key_unique']);
            $t->dropColumn('idempotency_key');
        });
    }
};
