<?php

namespace App\CRUD\Traits;

use Illuminate\Database\Eloquent\Model;

trait GetTrait
{
    /**      
     * The list of columns to fetch in show.
     * 
     * @var array
     */
    private $showColumns;

    /**      
     * The list of relation to eagar load in show.
     * 
     * @var array
     */
    private $showWiths;

    /**      
     * The list of columns to exclude in show.
     * 
     * @var array
     */
    private $exceptShowColumns;

    /**      
     * Add query in show.      
     *      
     * @param Illuminate\Database\Eloquent\Model $model      
     * 
     * @return Illuminate\Database\Eloquent\Model      
     */
    public function addShowClause(Model $model)
    {
        return $model;
    }

    /**
     * Get a resource.
     *
     * @param int
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function get($id)
    {
        $columns = $this->getShowColumns();
        
        // Selection of columns, Eagar Loading
        $query = $this->addShowClause($this->getModel())->select($columns)->with($this->getShowWiths());
        
        $item = $query->findorFail($id);
        
        return $item;
    }

    /**
     * Get the list of columns to fetch in show.
     *
     * @return array
     */
    public function getShowColumns()
    {
        $columns = null;
        if ($this->showColumns) {
            $columns = $this->showColumns;
        } else {
            // Fetch all columns from table of model.
            $columns = $this->getModel()->getConnection()->getSchemaBuilder()->getColumnListing($this->getModel()->getTable());
        }

        // Filter columns
        if ($this->exceptShowColumns) {
            $columns = array_diff($columns, $this->getExceptShowColumns());
        }

        return $columns;
    }

    /**
     * Set the list of columns to fetch in show.
     *
     * @param  array $columns
     * @return $this
     */
    public function setShowColumns(array $columns)
    {
        $this->showColumns = $columns;
    }

    /**
     * Get the list of columns to fetch in show.
     *
     * @return array
     */
    public function getExceptShowColumns()
    {
        if ($this->exceptShowColumns) {
            return $this->exceptShowColumns;
        } else {
            return [];
        }
    }

    /**
     * Set the list of columns to fetch in show.
     *
     * @param  array $columns
     * @return $this
     */
    public function setExceptShowColumns(array $columns)
    {
        $this->exceptShowColumns = $columns;
    }

    /**
     * Get the list of relationship to eagar load in show.
     *
     * @return array
     */
    public function getShowWiths()
    {
        if ($this->showWiths) {
            return $this->showWiths;
        } else {
            return [];
        }
    }

    /**
     * Set the list of relationship to eagar load in show.
     *
     * @param  array $with
     * @return $this
     */
    public function setShowWiths(array $withs)
    {
        $this->showWiths = $withs;
    }
}
