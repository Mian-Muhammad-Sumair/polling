<?php

namespace App\Repositories;

interface RoleRepositoryInterface
{
    /**
     * Get's all roles.
     *
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage);

    /**
     * Get's all related data for filling form.
     *
     * @return mixed
     */
    public function related();


    /**
     * Get's a role by it's ID
     *
     * @param string
     */
    public function get($id);

    /**
     * Creates a role.
     *
     * @param array
     */
    public function create(array $data);

    /**
     * Updates a role.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);

    /**
     * Deletes a role.
     *
     * @param int
     */
    public function delete($id);
}
