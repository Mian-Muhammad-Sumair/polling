<?php

namespace App\CRUD\Traits;

trait CreateTrait
{
    /**
     * Creates a resource.
     *
     * @param array
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $item = $this->getModel()->create($data);
        return $item;
    }
}
