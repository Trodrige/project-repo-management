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
          'project-list',
          'project-create',
          'project-edit',
          'project-delete',
          'project-validate',
          'project-download-zip',
          'user-list',
          'admin-list',
          'admin-create',
          'admin-edit',
          'admin-delete',
          'student-list',
          'student-create',
          'student-edit',
          'student-delete',
          'student-assign-project'
       ];

       foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
