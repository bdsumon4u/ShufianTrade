<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::truncate();
        \App\Setting::create([
            'name' => 'logo',
            'value' => [
                'favicon' => '',
                'desktop' => '',
                'mobile' => '',
            ],
        ]);
        \App\Setting::create([
            'name' => 'company',
            'value' => [
                'name' => 'SHOP 32',
                'phone' => '',
                'email' => '',
            ],
        ]);
        \App\Setting::create([
            'name' => 'social',
            'value' => [
                'facebook' => '',
            ],
        ]);
        \App\Setting::create([
            'name' => 'related_products',
            'value' => [
                'rows' => 3,
                'cols' => 5,
            ],
        ]);
        \App\Setting::create([
            'name' => 'products_page',
            'value' => [
                'rows' => 3,
                'cols' => 5,
            ],
        ]);
        \App\Setting::create([
            'name' => 'call_for_order',
            'value' => '',
        ]);
    }
}
