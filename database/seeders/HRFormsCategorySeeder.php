<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HRFormsCategory;

class HRFormsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Accounting',
            'Budget',
            'Cashier',
            'Dispatch',
            'HR',
            'Supply'
        ];

        foreach ($categories as $category) {
            HRFormsCategory::firstOrCreate(['name' => $category]);
        }
    }
}
