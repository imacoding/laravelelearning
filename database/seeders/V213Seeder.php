<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;

class V213Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $config = Config::where('key', '=', 'lesson_timer')->first();
       if ($config == null) {
           $config = new Config();
           $config->key = 'lesson_timer';
           $config->value = 0;
           $config->save();
       }
    }
}
