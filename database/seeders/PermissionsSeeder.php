<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'section access'],
            ['name' => 'section create'],
            ['name' => 'section update'],
            ['name' => 'section delete'],
            ['name' => 'section show'],
            ['name' => 'role access'],
            ['name' => 'role create'],
            ['name' => 'role update'],
            ['name' => 'role delete'],
            ['name' => 'role show'],
            ['name' => 'permission access'],
            ['name' => 'permission create'],
            ['name' => 'permission update'],
            ['name' => 'permission delete'],
            ['name' => 'permission show'],
            ['name' => 'user access'],
            ['name' => 'user create'],
            ['name' => 'user update'],
            ['name' => 'user delete'],
            ['name' => 'user show'],
            ['name' => 'product access'],
            ['name' => 'product create'],
            ['name' => 'product update'],
            ['name' => 'product delete'],
            ['name' => 'product show'],
            ['name' => 'blog access'],
            ['name' => 'blog create'],
            ['name' => 'blog update'],
            ['name' => 'blog delete'],
            ['name' => 'blog show'],
            ['name' => 'order access'],
            ['name' => 'order create'],
            ['name' => 'order update'],
            ['name' => 'order delete'],
            ['name' => 'order show'],
            ['name' => 'subcategory access'],
            ['name' => 'subcategory create'],
            ['name' => 'subcategory update'],
            ['name' => 'subcategory delete'],
            ['name' => 'subcategory show'],
            ['name' => 'setting access'],
            ['name' => 'dashboard access'],
            ['name' => 'page access'],
            ['name' => 'page settings'],
            ['name' => 'category access'],
            ['name' => 'category create'],
            ['name' => 'category update'],
            ['name' => 'category delete'],
            ['name' => 'category show'],
            ['name' => 'brand access'],
            ['name' => 'brand create'],
            ['name' => 'brand update'],
            ['name' => 'brand delete'],
            ['name' => 'brand show'],
            ['name' => 'slider access'],
            ['name' => 'slider create'],
            ['name' => 'slider update'],
            ['name' => 'slider delete'],
            ['name' => 'slider show'],
            ['name' => 'featuredbanner access'],
            ['name' => 'featuredbanner create'],
            ['name' => 'featuredbanner update'],
            ['name' => 'featuredbanner delete'],
            ['name' => 'featuredbanner show'],
            ['name' => 'race show'],
            ['name' => 'race access'],
            ['name' => 'race create'],
            ['name' => 'race edit'],
            ['name' => 'race delete'],
            ['name' => 'race import'],
            ['name' => 'blogcategory access'],
            ['name' => 'blogcategory create'],
            ['name' => 'blogcategory update'],
            ['name' => 'blogcategory delete'],
            ['name' => 'blogcategory show'],
            ['name' => 'currency access'],
            ['name' => 'currency create'],
            ['name' => 'currency update'],
            ['name' => 'currency delete'],
            ['name' => 'currency show'],
            ['name' => 'email access'],
            ['name' => 'email create'],
            ['name' => 'email update'],
            ['name' => 'email delete'],
            ['name' => 'email show'],
        ];

        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }
    }
}
