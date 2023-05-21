<?php
namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Artisan::call("cache:clear");

        $this->truncateMultiple([
            'cache',
            'jobs',
            'sessions',
        ]);

       /*$this->call(LocaleSeeder::class);
     // $this->call(AuthTableSeeder::class);
      /* $this->call(PageSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(SliderSeeder::class);
       $this->call(MenuSeeder::class);

       
        $this->call(TestimonialSeeder::class);
        $this->call(SponsorSeeder::class);
       $this->call(FaqSeeder::class);
      $this->call(ReasonSeeder::class);*/
       
        // $this->call(QuestionsSeed::class);
       //$this->call(ChatterTableSeeder::class);*/
       //$this->call(CourseSeed::class);
       

        //Artisan::call('translations:import');
        //Artisan::call('storage:link');
        Model::reguard();
    }
}
