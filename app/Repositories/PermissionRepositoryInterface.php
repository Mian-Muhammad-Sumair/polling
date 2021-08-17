<?php

namespace App\Repositories;

interface PermissionRepositoryInterface
{
    /**
     * Get all Permission's id.
     *
     */
    public function allIds();

    /**
     * Creates a Permission.
     *
     * @param string
     */
    public function create(array $data);
}
