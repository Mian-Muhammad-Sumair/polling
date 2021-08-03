<?php

namespace App\CRUD\Traits;


trait RelatedTrait
{
    /**      
     * The list of relation of which create and update needs data.
     * 
     * @var array
     */
    private $related;

    /**      
     * The list of parent related of which needs for dynamic fields.
     * 
     * @var array
     */
    private $parent_dynamic_fields = [];

    /**
     * Get's all related data.
     *
     * @param int
     * 
     * @return array
     */
    public function related()
    {
        $data = [];
        foreach ($this->getRelated() as $related) {
            if ($this->str->contains($related, ':')) {
                $relation = explode(':', $related);
                $relatedRelation = $relation[0];
                $relatedFields = explode(',', $relation[1]);
            } else {
                $relatedRelation = $related;
                $relatedFields = $this->getModel()->$relatedRelation()->getModel()->getConnection()->getSchemaBuilder()->getColumnListing($this->getModel()->$relatedRelation()->getModel()->getTable());
            }
            $query = $data[$this->str->snake($relatedRelation)] = $this->getModel()->$relatedRelation()->getModel()->select($relatedFields);
            $data[$this->str->snake($relatedRelation)] = $query->get();

        }

        return $data;
    }

    /**
     * Get the list of relation of which create and update needs data..
     *
     * @return array
     */
    public function getRelated()
    {
        if ($this->related) {
            return $this->related;
        } else {
            return [];
        }
    }

    /**
     * Set the list of relation of which create and update needs data..
     *
     * @param  array $with
     * @return $this
     */
    public function setRelated(array $related)
    {
        $this->related = $related;
    }

    /**
     * Get the list of relation of which create and update needs data..
     *
     * @return array
     */
    public function getParentDynamicFields()
    {
        if ($this->parent_dynamic_fields) {
            return $this->parent_dynamic_fields;
        } else {
            return [];
        }
    }

    /**
     * Set the list of relation of which create and update needs data..
     *
     * @param  array $with
     * @return $this
     */
    public function setParentDynamicFields(array $parent_dynamic_fields)
    {
        $this->parent_dynamic_fields = $parent_dynamic_fields;
    }
}
