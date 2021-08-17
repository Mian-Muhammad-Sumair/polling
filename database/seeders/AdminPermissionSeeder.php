<?php

namespace Database\Seeders;

use App\Repositories\PermissionRepositoryInterface;
use Illuminate\Database\Seeder;
use App\Traits\PermissionSeederTrait;

class AdminPermissionSeeder extends Seeder
{
    use PermissionSeederTrait;

    protected $permissions = [
        'Poll','Role & Permission','Customer'
    ];

    public function __construct()
    {
        $this->repository = resolve(PermissionRepositoryInterface::class);
        $this->guard_name = 'admin';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->processModules($this->permissions);
    }
}
