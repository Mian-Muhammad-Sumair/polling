<?php

namespace App\CRUD\Traits;

trait UpdateTrait
{
    /**
     * Update a resource.
     *
     * @param array
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $data)
    {
        $item = $this->getModel()->findorFail($id);
        $item->update($data);
        return $item;
    }
}
