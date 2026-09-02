<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class DummyAccommodationSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        $villa = DB::table('accommodation_categories')->insertGetId([
            'name' => 'Villa',
            'slug' => 'villa',
            'description' => 'Akomodasi villa yang nyaman untuk keluarga dan liburan.',
            'is_active' => true,
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kos = DB::table('accommodation_categories')->insertGetId([
            'name' => 'Kos',
            'slug' => 'kos',
            'description' => 'Tempat tinggal kos yang nyaman untuk mahasiswa dan pekerja.',
            'is_active' => true,
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | FACILITIES
        |--------------------------------------------------------------------------
        */

        $wifi = DB::table('facilities')->insertGetId([
            'name' => 'WiFi',
            'icon' => 'wifi',
            'description' => 'Internet WiFi tersedia.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $ac = DB::table('facilities')->insertGetId([
            'name' => 'AC',
            'icon' => 'snowflake',
            'description' => 'Pendingin ruangan.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $parkir = DB::table('facilities')->insertGetId([
            'name' => 'Parkir',
            'icon' => 'car',
            'description' => 'Area parkir kendaraan.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $dapur = DB::table('facilities')->insertGetId([
            'name' => 'Dapur',
            'icon' => 'utensils',
            'description' => 'Dapur tersedia untuk penghuni.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tv = DB::table('facilities')->insertGetId([
            'name' => 'TV',
            'icon' => 'tv',
            'description' => 'Televisi tersedia.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | RULES
        |--------------------------------------------------------------------------
        */

        $noSmoking = DB::table('rules')->insertGetId([
            'name' => 'Dilarang Merokok',
            'description' => 'Tidak diperbolehkan merokok di dalam ruangan.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $noPets = DB::table('rules')->insertGetId([
            'name' => 'Dilarang Membawa Hewan',
            'description' => 'Tidak diperbolehkan membawa hewan peliharaan.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $quiet = DB::table('rules')->insertGetId([
            'name' => 'Jam Tenang',
            'description' => 'Wajib menjaga ketenangan setelah pukul 22.00.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | ACCOMMODATIONS
        |--------------------------------------------------------------------------
        */

        $villaMawar = DB::table('accommodations')->insertGetId([
            'category_id' => $villa,
            'title' => 'Villa Mawar',
            'slug' => 'villa-mawar',
            'thumbnail' => 'accommodations/villa-mawar.jpg',
            'price' => 750000,
            'address' => 'Jl. Raya Nganjuk No. 15, Nganjuk',
            'latitude' => -7.6051000,
            'longitude' => 111.9048000,
            'capacity' => 6,
            'bedroom' => 3,
            'bathroom' => 2,
            'size' => 120,
            'status' => 'Available',
            'description' => 'Villa nyaman dengan tiga kamar tidur, cocok untuk keluarga dan liburan bersama.',
            'meta_title' => 'Villa Mawar Nganjuk',
            'meta_description' => 'Villa nyaman dengan fasilitas lengkap di Nganjuk.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $villaMelati = DB::table('accommodations')->insertGetId([
            'category_id' => $villa,
            'title' => 'Villa Melati',
            'slug' => 'villa-melati',
            'thumbnail' => 'accommodations/villa-melati.jpg',
            'price' => 600000,
            'address' => 'Jl. Begadung No. 21, Nganjuk',
            'latitude' => -7.6035000,
            'longitude' => 111.9025000,
            'capacity' => 4,
            'bedroom' => 2,
            'bathroom' => 1,
            'size' => 90,
            'status' => 'Available',
            'description' => 'Villa nyaman dan tenang untuk keluarga kecil dengan fasilitas lengkap.',
            'meta_title' => 'Villa Melati Nganjuk',
            'meta_description' => 'Villa nyaman dan terjangkau di Nganjuk.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $villaAnggrek = DB::table('accommodations')->insertGetId([
            'category_id' => $villa,
            'title' => 'Villa Anggrek',
            'slug' => 'villa-anggrek',
            'thumbnail' => 'accommodations/villa-anggrek.jpg',
            'price' => 900000,
            'address' => 'Jl. Diponegoro No. 45, Nganjuk',
            'latitude' => -7.6072000,
            'longitude' => 111.9061000,
            'capacity' => 8,
            'bedroom' => 4,
            'bathroom' => 2,
            'size' => 150,
            'status' => 'Available',
            'description' => 'Villa luas dengan empat kamar tidur yang cocok untuk rombongan keluarga.',
            'meta_title' => 'Villa Anggrek Nganjuk',
            'meta_description' => 'Villa luas dan nyaman untuk keluarga besar.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kosAnggrek = DB::table('accommodations')->insertGetId([
            'category_id' => $kos,
            'title' => 'Kos Anggrek',
            'slug' => 'kos-anggrek',
            'thumbnail' => 'accommodations/kos-anggrek.jpg',
            'price' => 850000,
            'address' => 'Jl. Dr. Soetomo No. 25, Nganjuk',
            'latitude' => -7.6020000,
            'longitude' => 111.9070000,
            'capacity' => 1,
            'bedroom' => 1,
            'bathroom' => 1,
            'size' => 20,
            'status' => 'Available',
            'description' => 'Kos nyaman dan strategis untuk mahasiswa maupun pekerja.',
            'meta_title' => 'Kos Anggrek Nganjuk',
            'meta_description' => 'Kos nyaman dan strategis di Nganjuk.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kosMelati = DB::table('accommodations')->insertGetId([
            'category_id' => $kos,
            'title' => 'Kos Melati',
            'slug' => 'kos-melati',
            'thumbnail' => 'accommodations/kos-melati.jpg',
            'price' => 700000,
            'address' => 'Jl. Ahmad Yani No. 30, Nganjuk',
            'latitude' => -7.6060000,
            'longitude' => 111.9010000,
            'capacity' => 1,
            'bedroom' => 1,
            'bathroom' => 1,
            'size' => 18,
            'status' => 'Available',
            'description' => 'Kos bersih dan nyaman dengan lokasi yang strategis.',
            'meta_title' => 'Kos Melati Nganjuk',
            'meta_description' => 'Kos murah dan nyaman di Nganjuk.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kosKenanga = DB::table('accommodations')->insertGetId([
            'category_id' => $kos,
            'title' => 'Kos Kenanga',
            'slug' => 'kos-kenanga',
            'thumbnail' => 'accommodations/kos-kenanga.jpg',
            'price' => 950000,
            'address' => 'Jl. Gatot Subroto No. 12, Nganjuk',
            'latitude' => -7.6080000,
            'longitude' => 111.9030000,
            'capacity' => 1,
            'bedroom' => 1,
            'bathroom' => 1,
            'size' => 22,
            'status' => 'Available',
            'description' => 'Kos dengan fasilitas lengkap dan lingkungan yang nyaman.',
            'meta_title' => 'Kos Kenanga Nganjuk',
            'meta_description' => 'Kos dengan fasilitas lengkap di Nganjuk.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | ACCOMMODATION FACILITIES
        |--------------------------------------------------------------------------
        */

        DB::table('accommodation_facilities')->insert([
            ['accommodation_id' => $villaMawar,   'facility_id' => $wifi],
            ['accommodation_id' => $villaMawar,   'facility_id' => $ac],
            ['accommodation_id' => $villaMawar,   'facility_id' => $parkir],
            ['accommodation_id' => $villaMawar,   'facility_id' => $dapur],

            ['accommodation_id' => $villaMelati,  'facility_id' => $wifi],
            ['accommodation_id' => $villaMelati,  'facility_id' => $ac],
            ['accommodation_id' => $villaMelati,  'facility_id' => $parkir],

            ['accommodation_id' => $villaAnggrek, 'facility_id' => $wifi],
            ['accommodation_id' => $villaAnggrek, 'facility_id' => $ac],
            ['accommodation_id' => $villaAnggrek, 'facility_id' => $parkir],
            ['accommodation_id' => $villaAnggrek, 'facility_id' => $dapur],
            ['accommodation_id' => $villaAnggrek, 'facility_id' => $tv],

            ['accommodation_id' => $kosAnggrek,   'facility_id' => $wifi],
            ['accommodation_id' => $kosAnggrek,   'facility_id' => $ac],
            ['accommodation_id' => $kosAnggrek,   'facility_id' => $parkir],

            ['accommodation_id' => $kosMelati,   'facility_id' => $wifi],
            ['accommodation_id' => $kosMelati,   'facility_id' => $parkir],

            ['accommodation_id' => $kosKenanga,  'facility_id' => $wifi],
            ['accommodation_id' => $kosKenanga,  'facility_id' => $ac],
            ['accommodation_id' => $kosKenanga,  'facility_id' => $parkir],
            ['accommodation_id' => $kosKenanga,  'facility_id' => $tv],
        ]);


        /*
        |--------------------------------------------------------------------------
        | ACCOMMODATION RULES
        |--------------------------------------------------------------------------
        */

        DB::table('accommodation_rules')->insert([
            ['accommodation_id' => $villaMawar,   'rule_id' => $noSmoking],
            ['accommodation_id' => $villaMawar,   'rule_id' => $noPets],

            ['accommodation_id' => $villaMelati,  'rule_id' => $noSmoking],
            ['accommodation_id' => $villaMelati,  'rule_id' => $noPets],

            ['accommodation_id' => $villaAnggrek, 'rule_id' => $noSmoking],

            ['accommodation_id' => $kosAnggrek,   'rule_id' => $noSmoking],
            ['accommodation_id' => $kosAnggrek,   'rule_id' => $quiet],

            ['accommodation_id' => $kosMelati,   'rule_id' => $noSmoking],
            ['accommodation_id' => $kosMelati,   'rule_id' => $quiet],

            ['accommodation_id' => $kosKenanga,  'rule_id' => $noSmoking],
            ['accommodation_id' => $kosKenanga,  'rule_id' => $quiet],
        ]);


        /*
        |--------------------------------------------------------------------------
        | ACCOMMODATION IMAGES
        |--------------------------------------------------------------------------
        */

        
    }
}