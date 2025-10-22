<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThirdPartySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = app(\App\Models\Settings\ThirdPartySettings::class);

        $settings->stripe_publishable_key = "";
        $settings->stripe_secret_key = "";

        $settings->save();
    }
}
