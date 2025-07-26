<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory(1)->create();

        \App\Models\Permission::factory()->create([
            'key' => 'users_view',
            'name' => 'مدیریت کاربران',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'users_create',
            'name' => 'ایجاد کاربر جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'users_edit',
            'name' => 'ویرایش کاربر',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'contacts_view',
            'name' => 'مدیریت مخاطبین',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'contacts_create',
            'name' => 'ایجاد مخاطب جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'contacts_edit',
            'name' => 'ویرایش مخاطب',
        ]);


        \App\Models\Permission::factory()->create([
            'key' => 'r_category_view',
            'name' => 'مدیریت دسته بندی ارتباطات',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'r_category_create',
            'name' => 'ایجاد دسته بندی ارتباطات جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'r_category_edit',
            'name' => 'ویرایش دسته بندی ارتباطات',
        ]);


        \App\Models\Permission::factory()->create([
            'key' => 'relations_view',
            'name' => 'مدیریت ارتباطات',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'relations_create',
            'name' => 'ایجاد ارتباطات جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'relations_edit',
            'name' => 'ویرایش ارتباطات',
        ]);


        \App\Models\Permission::factory()->create([
            'key' => 'products_view',
            'name' => 'مدیریت محصولات',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'products_create',
            'name' => 'ایجاد محصول جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'products_edit',
            'name' => 'ویرایش محصول',
        ]);


        \App\Models\Permission::factory()->create([
            'key' => 'p_category_view',
            'name' => 'مدیریت دسته بندی محصولات',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'p_category_create',
            'name' => 'ایجاد دسته بندی محصول جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'p_category_edit',
            'name' => 'ویرایش دسته بندی محصول',
        ]);


        \App\Models\Permission::factory()->create([
            'key' => 'product_serial_view',
            'name' => 'مدیریت بارکد محصولات',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'product_serial_create',
            'name' => 'ایجاد بارکد محصول جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'product_serial_edit',
            'name' => 'ویرایش بارکد محصول',
        ]);


        \App\Models\Permission::factory()->create([
            'key' => 'representation_view',
            'name' => 'مدیریت نمایندگی ها',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'representation_create',
            'name' => 'ایجاد نمایندگی جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'representation_edit',
            'name' => 'ویرایش نمایندگی',
        ]);


        \App\Models\Permission::factory()->create([
            'key' => 'box_view',
            'name' => 'مدیریت کارتن ها',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'box_create',
            'name' => 'ایجاد کارتن جدید',
        ]);

        \App\Models\Permission::factory()->create([
            'key' => 'box_edit',
            'name' => 'ویرایش کارتن',
        ]);






    }
}
