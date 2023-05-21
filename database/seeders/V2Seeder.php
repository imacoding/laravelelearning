<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use App\Models\OrderItem;
use Illuminate\Support\Arr;

class V2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'bundle_access',
            'bundle_create',
            'bundle_edit',
            'bundle_view',
            'bundle_delete'
        ];
        $permission_ids = [];

        foreach ($permissions as $item) {
            Permission::findOrCreate($item);
        }
        Artisan::call('cache:clear');

        $admin = Role::findByName('administrator');
        $admin->givePermissionTo($permissions);

        $teacher = Role::findByName('teacher');
        $teacher->givePermissionTo($permissions);

        $student = Role::findByName('student');
        $student->givePermissionTo(['bundle_view', 'bundle_access']);

        $menus = [
            [
                'url' => 'bundles',
                'name' => 'Bundles'
            ],
        ];

        $nav_menu = Menus::where('name', '=', 'nav-menu')->first();
        if ($nav_menu == null) {
            $nav_menu = new Menus();
            $nav_menu->name = 'nav-menu';
            $nav_menu->save();
        }

        foreach ($menus as $key => $item) {
            $key++;
            $menuItem = MenuItems::where('link', '=', $item['url'])
                ->where('menu', '=', $nav_menu->id)->first();
            if ($menuItem == null) {
                $menuItem = new MenuItems();
                $menuItem->label = $item['name'];
                $menuItem->link = Arr::last(explode('/', $item['url']));
                $menuItem->parent = 0;
                $menuItem->sort = $key;
                $menuItem->menu = $nav_menu->id;
                $menuItem->depth = 0;
                $menuItem->save();
            }
        }

        //=========Order fix ===================//

        OrderItem::where('item_type','=',null)->update(['item_type'=>'\App\Models\Course']);

    }
}
