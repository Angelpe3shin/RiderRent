<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Engine;
use App\Models\MotoModel;
use App\Models\Color;
use App\Models\Moto;
use App\Models\Discount;
use App\Models\Country;
use App\Models\Address;
use App\Models\User;
use App\Models\UserBasket;
use App\Models\Rent;
use App\Models\RentPoint;
use App\Models\RentPointUser;
use App\Models\RentPointRent;
use App\Models\RentPointMoto;

class DatabaseSeeder extends Seeder {
    public function run() {
        Brand::factory()->count(5)->create();
        Engine::factory()->count(15)->create();
        MotoModel::factory()->count(7)->create();
        Color::factory()->count(4)->create();
        Moto::factory()->count(7)->create();
        Discount::factory()->count(5)->create();
        Country::factory()->count(7)->create();
        Address::factory()->count(7)->create();
        User::factory()->count(7)->create();
        UserBasket::factory()->count(7)->create();
        Rent::factory()->count(3)->create();
        RentPoint::factory()->count(1)->create();
        RentPointUser::factory()->count(7)->create();
        RentPointRent::factory()->count(3)->create();
        RentPointMoto::factory()->count(7)->create();
    }
}
