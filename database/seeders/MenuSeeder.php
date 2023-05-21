<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
          \Harimayco\Menu\Models\MenuItems::truncate();
    \Harimayco\Menu\Models\Menus::truncate();
    // delete the nav_menu config
    \App\Models\Configs::where('key', 'nav_menu')->delete();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $menus = [
            [
                'url' => route('blogs.all'),
                'name' => 'Blog'
            ],
            [
                'url' => route('courses.all'),
                'name' => 'Courses'
            ],
            [
                'url' => route('bundles.all'),
                'name' => 'Bundles'
            ],
            [
                'url' => asset('forums'),
                'name' => 'Forums'
            ],
            [
                'url' => asset('contact'),
                'name' => 'Contact'
            ],
            [
                'url' => asset('about-us'),
                'name' => 'About Us'
            ]
        ];

        $nav_menu = \Harimayco\Menu\Models\Menus::where('name', '=', 'nav-menu')->first();
        if ($nav_menu == "") {
            $nav_menu = new \Harimayco\Menu\Models\Menus();
        }
        $nav_menu->name = 'nav-menu';
        $nav_menu->save();
        foreach ($menus as $key => $item) {
            $key++;
            $menuItem = \Harimayco\Menu\Models\MenuItems::where('link', '=', $item['url'])
                ->where('label','=',$item['name'])
                ->where('menu', '=', $nav_menu->id)->first();
            if ($menuItem == "") {
                $menuItem = new \Harimayco\Menu\Models\MenuItems();
                $menuItem->label = $item['name'];
                $menuItem->link = \Illuminate\Support\Arr::last(explode('/', $item['url']));
                $menuItem->parent = 0;
                $menuItem->sort = $key;
                $menuItem->menu = $nav_menu->id;
                $menuItem->depth = 0;
                $menuItem->save();
                $menuItem->parent = $menuItem->id;
                $menuItem->save();

            }
        }

        $nav_menu_config = \App\Models\Configs::firstOrCreate(['key'=>'nav_menu']);
        $nav_menu_config->value = $nav_menu->id;
        $nav_menu_config->save();


        $menus = \Harimayco\Menu\Models\Menus::all();
        foreach ($menus as $menu) {
            if ($menu != NULL) {
                $menuItems = \Harimayco\Menu\Models\MenuItems::where('menu', '=', $menu->id)->get();
                if ($menuItems != null) {
                    $allMenu = [];
                    foreach ($menuItems as $item) {
                        $allMenu[str_slug($item['label'])] = $item['label'];
                    }
                    $main[str_slug($menu->name)] = $allMenu;
                    $file = fopen(public_path('../resources/lang/en/custom-menu.php'), 'a');
                    if ($file !== false) {
                        ftruncate($file, 0);
                    }
                    fwrite($file, '<?php return ' . var_export($main, true) . ';');

                    Artisan::call('menu:import');
                }
            }
        }

    }
}
