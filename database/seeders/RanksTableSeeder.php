<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            'Newcomer', 'Amateur', 'Rookie', 'Semi-Pro', 'Professional',
            'Veteran', 'Expert', 'Master', 'Champion', 'Grand Champion',
            'Legend', 'Mythic'
        ];

        foreach ($ranks as $rankName) {
            Rank::create([
                'name' => $rankName,
            ]);
        }
    }
}
