<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [];
        for ($i = 1; $i <= 6; $i++) {
            $sponsors[] = [
                'name' => 'Dummy ' . $i,
                'logo' => 's-1.jpg',
                'link' => '#'
            ];
        }
        Sponsor::insert($sponsors);
    }
}
