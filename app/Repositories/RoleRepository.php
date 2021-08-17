<?php

namespace App\Repositories;

use App\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * @var Role
     */
    protected $model;

    /**
     * The guard name role associated with.
     *
     * @var string
     */
    public $guard_name;

    /**
     * UserRepository constructor.
     *
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Get's all roles.
     *
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage)
    {
        return $this->model->whereGuardName($this->guard_name)->latest()->paginate($perPage);
    }
    /**
     * Get's all related data.
     *
     * @param int
     * @return mixed
     */
    public function related()
    {
        $data = [];
        $data['permissions'] = $this->model->permissions()->getModel()->whereGuardName($this->guard_name)->select('id','name')->get();
        return $data;
    }


    /**
     * Get's a role by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return $this->model->with('permissions')->whereGuardName($this->guard_name)->whereKey($id)->firstorFail();
    }

    /**
     * Creates a role.
     *
     * @param array
     */
    public function create(array $data)
    {
        $prm = [];
        $data['guard_name'] = $this->guard_name;
        // dd($perm);
        $permissions = $data['permissions'];
//        dd($permissions);
//        $permissions = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
//        dd($permissions);
        unset($data['permissions']);
        $item = $this->model->create($data);
        //        foreach ($permissions as $index=>$permission) {
        //            $permissionName = Permission::where('id', $permission)->select('id')->get();
        //            $el = $permissionName->pluck('id')->all();
        //            array_push($prm,$el[0]);
        //        }
        $item->permissions()->attach($permissions);
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        return $item;
    }

    /**
     * Deletes a role.
     *
     * @param int
     */
    public function delete($id)
    {
        $item = $this->get($id);
        $item->delete();
    }

    /**
     * Updates a role.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
        $prm = [];
        $item = $this->get($id);
        $permissions = $data['permissions'];
        // foreach ($permissions as $index => $permission) {
        //     $permissionName = Permission::where('name', $permission)->select('id')->get();
        //     $el = $permissionName->pluck('id')->all();
        //     array_push($prm, $el[0]);
        // }
        unset($data['permissions']);
        $item->update($data);
        $item->permissions()->detach();
        $item->permissions()->attach($permissions);
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        return $item;

    }
}
