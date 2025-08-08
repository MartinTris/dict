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
        $district3 = District::firstOrCreate([
            'district_name' => 'III',
            'province_id' => $province->id,
        ]);
        $district4 = District::firstOrCreate([
            'district_name' => 'IV',
            'province_id' => $province->id,
        ]);
        $district5 = District::firstOrCreate([
            'district_name' => 'V',
            'province_id' => $province->id,
        ]);
        $district6 = District::firstOrCreate([
            'district_name' => 'VI',
            'province_id' => $province->id,
        ]);
        $district7 = District::firstOrCreate([
            'district_name' => 'VII',
            'province_id' => $province->id,
        ]);
        $district8 = District::firstOrCreate([
            'district_name' => 'VIII',
            'province_id' => $province->id,
        ]);

        // District I Localities
        Locality::firstOrCreate([
            'locality_name' => 'Cavite City',
            'district_id' => $district1->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Kawit',
            'district_id' => $district1->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Noveleta',
            'district_id' => $district1->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Rosario',
            'district_id' => $district1->id,
        ]);

        // District II Localities
        Locality::firstOrCreate([
            'locality_name' => 'Bacoor',
            'district_id' => $district2->id,
        ]);

        // District III Localities
        Locality::firstOrCreate([
            'locality_name' => 'Imus',
            'district_id' => $district3->id,
        ]);

        // District IV Localities
        Locality::firstOrCreate([
            'locality_name' => 'Dasmariñas City',
            'district_id' => $district4->id,
        ]);
        
        // District V Localities
        Locality::firstOrCreate([
            'locality_name' => 'Carmona',
            'district_id' => $district5->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Gen. Mariano Alvarez',
            'district_id' => $district5->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Silang',
            'district_id' => $district5->id,
        ]);
        
        // District VI Localities
        Locality::firstOrCreate([
            'locality_name' => 'General Trias City',
            'district_id' => $district6->id,
        ]);
        
        // District VII Localities
        Locality::firstOrCreate([
            'locality_name' => 'Amadeo',
            'district_id' => $district7->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Indang',
            'district_id' => $district7->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Tanza',
            'district_id' => $district7->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Trece Martires City',
            'district_id' => $district7->id,
        ]);

        // District VIII Localities
        Locality::firstOrCreate([
            'locality_name' => 'Alfonso',
            'district_id' => $district8->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Gen. Emilio Aguinaldo',
            'district_id' => $district8->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Magallanes',
            'district_id' => $district8->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Maragondon',
            'district_id' => $district8->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Mendez',
            'district_id' => $district8->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Naic',
            'district_id' => $district8->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Tagaytay City',
            'district_id' => $district8->id,
        ]);
        Locality::firstOrCreate([
            'locality_name' => 'Ternate',
            'district_id' => $district8->id,
        ]);

        


    }
}
