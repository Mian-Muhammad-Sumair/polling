<?php

namespace App\CRUD\Repositories;

interface BaseCRUDRepositoryInterface
{
    /**
     * Get's all Industries.
     *
     * @param int
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
     * Get's a Industry by it's ID
     *
     * @param string
     */
    public function get($id);

    /**
     * Creates a Industry.
     *
     * @param array
     */
    public function create(array $data);

    /**
     * Updates a Industry.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);

    /**
     * Deletes a Industry.
     *
     * @param int
     */
    public function delete($id);
}
