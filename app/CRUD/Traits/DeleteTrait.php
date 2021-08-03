<?php

namespace App\CRUD\Traits;

trait DeleteTrait
{
    /**
     * Destroy a resource.
     *
     * @param int
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function delete($id)
    {
        $item = $this->getModel()->findorFail($id);
        $item->delete();
        return $item;
    }
}
