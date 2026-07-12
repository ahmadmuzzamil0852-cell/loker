<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('produks')->update([
            'stok' => 0
        ]);

        Schema::table('produks', function (Blueprint $table) {
            $table->integer('stok')
                ->default(0)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->string('stok')
                ->default('Tersedia')
                ->change();
        });
    }
};