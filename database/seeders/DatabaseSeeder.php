<?php

namespace Database\Seeders;

use App\Models\Advert;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users= \App\Models\User::factory(25)->create();
         $advert=Advert::factory(100)->make(['user_id'=>null])->each(function ($advert) use($users){
             $advert->user_id = $users->random()->id;
           $advert->image_patch=mb_substr($advert->image_patch,7);
           $advert->save();


         } );
    }
}
