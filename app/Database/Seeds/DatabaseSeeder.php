<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Config\Database;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $seeder = Database::seeder();
        $seeder->call('UsersSeeder');
        $seeder->call('WeddingTimeSeeder');
        $seeder->call('ProductSeeder');
        $seeder->call('SubProductSeeder');
        $seeder->call('BookingSeeder');
    }
}
