<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            ['name' => 'Mumbai Branch', 'code' => 'MUM001', 'address' => '123 Marine Drive, Mumbai', 'status' => 'active'],
            ['name' => 'Delhi Branch', 'code' => 'DEL001', 'address' => '456 Connaught Place, Delhi', 'status' => 'active'],
            ['name' => 'Bangalore Branch', 'code' => 'BNG001', 'address' => '789 MG Road, Bangalore', 'status' => 'active'],
            ['name' => 'Pune Branch', 'code' => 'PUN001', 'address' => '321 Bund Garden, Pune', 'status' => 'active'],
        ];

        foreach ($branches as $branchData) {
            Branch::firstOrCreate(['code' => $branchData['code']], $branchData);
        }

        echo "Branches created: " . Branch::count() . "\n";
    }
}
