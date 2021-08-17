<?php

namespace App\Models;

use Gmz\Common\Traits\UUIDTrait;
use Gmz\Common\Traits\SwitchCompanyDatabaseTrait;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends SpatieRole
{

    /**
     * A role may be given various permissions.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            config('permission.table_names.role_has_permissions'),
            'role_id',
            'permission_id'
        );
    }

    public function getPermissionClass()
    {
        return app(Permission::class);
    }
}
