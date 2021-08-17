<?php

namespace App\Traits;

trait PermissionSeederTrait
{
    public $repository;

    public $permissionsArray = [];

    public $guard_name;

    public $permissionsPrefix = null;

    /**
     * Process Modules
     *
     * @param array $modules
     * @return void
     */
    public function processModules(array $modules = null)
    {
        $newPermissions=[
            'Product Profile', 'Product Modifier', 'Product Category', 'Product Sub Category',
            'Product Unit', 'Product Drug Category', 'Line Item', 'Packaging Type',
            'Group', 'Manufacturer', 'Supplier','Tag', 'Rack'
        ];
        foreach ($modules as $module => $permissions) {
            if (gettype($module) === 'integer') {
                $module = $permissions;
                $permissions = ['View', 'Create', 'Update', 'Delete'];
            }
            $this->generatePermissions($module, $permissions);
        }
        $this->repository->createMany($this->permissionsArray);
    }

    /**
     * Create Permissions
     *
     * @param string $module
     * @param array $permissions
     * @return void
     */
    public function generatePermissions(string $module, array $permissions = null)
    {
        foreach ($permissions as $permission) {
            $name = "$permission $module";
            if ($this->permissionsPrefix) {
                $name = "{$this->permissionsPrefix}$name";
            }
            $data['name'] = $name;
            array_push($this->permissionsArray, [
                'name' => $name,
                'guard_name' => $this->guard_name,
            ]);
        }
    }
}
