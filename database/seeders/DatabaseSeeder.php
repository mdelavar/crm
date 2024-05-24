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


    }
}
