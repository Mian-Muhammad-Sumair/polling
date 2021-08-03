<?php

namespace App\CRUD\Traits;

use Laravel\Telescope\Storage\EntryModel;
use Laravel\Telescope\Storage\EntryQueryOptions;

trait TimelineTrait
{
    /**
     * Get timeline of a resource.
     *
     * @param array
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function timeline($id)
    {
        $item = $this->getModel()->findorFail($id);
        $options = new EntryQueryOptions();
        $modelClassName = get_class($this->getModel());
        $options->tag = "$modelClassName:$item->id";
        $logs = EntryModel::select('content', 'created_at')->withTelescopeOptions('model', $options);
        $options->tag = "company:" . config('database.company');
        $logs = $logs->withTelescopeOptions('model', $options)->get();

        return $logs;
    }
}
