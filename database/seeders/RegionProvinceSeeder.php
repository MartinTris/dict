<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Province;
use App\Models\District;
use App\Models\Locality;

class RegionProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $region = Region::firstOrCreate(['region_code' => 'IV-A']);

        $province = Province::firstOrCreate([
            'province_name' => 'Cavite',
            'region_id' => $region->id,
        ]);

        $district1 = District::firstOrCreate([
            'district_name' => 'I',
            'province_id' => $province->id,
        ]);

        $district2 = District::firstOrCreate([
            'district_name' => 'II',
            'province_id' => $province->id,
        ]);

        Locality::firstOrCreate([
            'locality_name' => 'Cavite City',
            'district_id' => $district1->id,
        ]);

        Locality::firstOrCreate([
            'locality_name' => 'Kawit',
            'district_id' => $district1->id,
        ]);

        Locality::firstOrCreate([
            'locality_name' => 'City of Bacoor',
            'district_id' => $district2->id,
        ]);

    }
}
