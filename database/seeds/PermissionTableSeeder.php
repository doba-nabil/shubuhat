<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'question-list',
            'question-create',
            'question-edit',
            'question-show',
            'question-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'media-list',
            'media-create',
            'media-edit',
            'media-delete',

            'comment-list',
            'comment-show',
            'comment-delete',

            'contact-index',
            'contact-show',
            'contact-delete',

            'folders-list',
            'folders-create',
            'folders-edit',
            'folders-show',
            'folders-delete',

            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',

            'option-edit',

            'page-list',
            'page-create',
            'page-edit',
            'page-delete',

            'subscriber-list',
            'subscriber-create',
            'subscriber-delete'
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
