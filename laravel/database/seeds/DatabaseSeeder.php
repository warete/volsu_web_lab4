<?php

use Illuminate\Database\Seeder;
use App\City;
use App\Shop;
use App\Request;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call('CitiesTableSeeder');
        $this->command->info('Таблица городов загружена данными!');*/
        /*$this->call('ShopsTableSeeder');
        $this->command->info('Таблица магазинов загружена данными!');*/
        $this->call('RequestsTableSeeder');
        $this->command->info('Таблица заявок загружена данными!');
    }
}

class CitiesTableSeeder extends Seeder {

    public function run()
    {
        City::create(['name' => 'Волгоград']);
        City::create(['name' => 'Москва']);
        City::create(['name' => 'Санкт-Петербург']);
    }

}

class ShopsTableSeeder extends Seeder {

    public function run()
    {
        Shop::create(['longitude' => 44.436522, 'latitude' => 48.636252, 'address' => 'Университетский просп., 107', 'city_id' => 1]);
        Shop::create(['longitude' => 44.478005, 'latitude' => 48.756494, 'address' => 'Историческая ул., 175', 'city_id' => 1]);
        Shop::create(['longitude' => 37.664133, 'latitude' => 55.785718, 'address' => 'Верхняя Красносельская ул., 3А', 'city_id' => 2]);
    }

}

class RequestsTableSeeder extends Seeder {

    public function run()
    {
        Request::create(['name' => 'Синие носки с котятами', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus adipisci animi doloremque id inventore laborum odio quibusdam repudiandae tempore?', 'status' => 1, 'shop_id' => 1, 'user_id' => 1]);
    }

}
