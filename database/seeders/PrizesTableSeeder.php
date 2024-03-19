<?php

namespace Database\Seeders;

use App\Models\Prize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prize::create(['name' => 'Lottery 1', 'type' => 'lottery_ticket']);
        Prize::create(['name' => 'BNB', 'type' => 'custom_prize']);
    }
}
