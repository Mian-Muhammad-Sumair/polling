<?php


namespace App\Repositories;


interface SubscribeRepositoryInterface
{
    /**
     * Get's all employee accounts.
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
    public function create(array $data);


    /**
     * Deletes a employee account.
     *
     * @param int
     */
    public function delete($id);
}
