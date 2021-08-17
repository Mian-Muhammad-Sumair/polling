<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{

    /**
     * A permission can be applied to roles.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            config('permission.table_names.role_has_permissions'),
            'permission_id',
            'role_id'
        );
    }

    /**
     * Get the current cached permissions.
     */
//    protected static function getPermissions(array $params = [])
//    {
//        $query = static::select('id', 'name', 'guard_name')
//            ->with('roles:id,name,guard_name');
//
//        foreach ($params as $attr => $value) {
//            $query = $query->where($attr, $value);
//        }
//
//        $permissions = $query->get();
//
//        return $permissions;
//    }
}
