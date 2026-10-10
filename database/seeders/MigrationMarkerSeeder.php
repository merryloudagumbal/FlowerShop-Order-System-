<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrationMarkerSeeder extends Seeder
{
    public function run(): void
    {
        $migrations = [
            '0001_01_01_000000_create_users_table',
            '0001_01_01_000001_create_cache_table',
            '0001_01_01_000002_create_jobs_table',
            '2026_09_14_000001_add_role_to_users_table',
            '2026_09_14_000002_create_products_table',
            '2026_09_14_000003_create_orders_table',
            '2026_09_14_000004_create_order_items_table',
        ];

        foreach ($migrations as $m) {
            DB::table('migrations')->updateOrInsert([
                'migration' => $m,
            ], [
                'batch' => 1,
            ]);
        }
    }
}
