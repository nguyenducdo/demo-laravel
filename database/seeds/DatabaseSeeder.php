<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('sanpham')->insert(
        //  ['id'=>null,'name'=>'Laptop dell']
        // );

        $this->call(SPSeeder::class);
        // $this->call(LoaiSPSeeder::class);
        
        // DB::table('users')->insert([
        //     ['username'=>'do','email'=>'do@gmail.com','password'=>Hash::make('123')],
        //     ['username'=>'nguyen','email'=>'nguyen@gmail.com','password'=>Hash::make('123')],
        //     ['username'=>'duc','email'=>'duc@gmail.com','password'=>Hash::make('123')],
        // ]);
    }
}

class SPSeeder extends Seeder{
	public function run(){
		DB::table('sanpham')->insert([
        	['id'=>null,'name'=>'Laptop '. Str::random(4),'id_loaisanpham'=>rand(1,3)],
        	['id'=>null,'name'=>'Laptop '. Str::random(4),'id_loaisanpham'=>rand(1,3)],
        	['id'=>null,'name'=>'Laptop '. Str::random(4),'id_loaisanpham'=>rand(1,3)],
        	['id'=>null,'name'=>'Laptop '. Str::random(4),'id_loaisanpham'=>rand(1,3)]
        ]);
	}
}

class LoaiSPSeeder extends Seeder{
	public function run(){
		DB::table('loaisanpham')->insert([
			['name'=>'PC'],
			['name'=>'Laptop'],
			['name'=>'Mobile']
		]);
	}
}