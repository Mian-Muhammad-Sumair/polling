<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Repositories\RoleRepositoryInterface;
use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{

    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;

    public function __construct()
    {
        $guard_name = 'admin';
        $this->roleRepository = resolve(RoleRepositoryInterface::class);
        $this->roleRepository->guard_name = $guard_name;

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin' => [''],
            'Team Lead' => ['View Poll', 'View Customer'],
            'Customer Account Manager' => ['View Poll', 'View Customer']
        ];
        $defaultPermissionsNames=[];
        foreach ($roles as $role => $permissionsNames) {
            if($role=='Admin'){
                $permissions = Permission::where('guard_name', 'admin')->get()->pluck('id'); // get guard name employee all permissions ids
            }else{
                $permissionsNames=array_merge($permissionsNames,$defaultPermissionsNames);
                $permissions = Permission::whereIn('name', $permissionsNames)->where('guard_name', 'admin')->get()->pluck('id'); // get guard name employee custom permissions ids
            }
            $this->roleRepository->create([
                'name' => $role,
                'permissions' => $permissions
            ]);
        }
    }
}
