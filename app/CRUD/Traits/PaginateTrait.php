<?php

namespace App\CRUD\Traits;

use Illuminate\Database\Eloquent\Model;

trait PaginateTrait
{
    /**      
     * The list of columns to fetch in index.
     * 
     * @var array
     */
    private $indexColumns;

    /**      
     * The list of relation to eagar load in index.
     * 
     * @var array
     */
    private $indexWiths;

    /**      
     * The list of columns to exclude in index.
     * 
     * @var array
     */
    private $exceptIndexColumns;

    /**      
     * Add query in index.      
     *      
     * @param Illuminate\Database\Eloquent\Model $model      
     * @param array $params      
     * 
     * @return Illuminate\Database\Eloquent\Model      
     */
    public function addIndexClause(Model $model, array $params)
    {
        return $model;
    }

    /**
     * Get all resources.
     *
     * @param int
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        $localParams = [
            'sortField' => 'created_at',
            'sortOrder' => 'desc',
            'perPage' => 10,
            'searchKeyword' => null,
        ];
        $params = array_merge($localParams, $params);

        $columns = $this->getIndexColumns();

        // Selection of columns, Eagar Loading
        $query = $this->addIndexClause($this->getModel(), $params)->select($columns)->with($this->getIndexWiths());

        // Sorting
        if ($this->str->contains($params['sortField'], '.')) {
            $sortField = explode('.', $params['sortField']);
            $sortRalation = $this->str->camel($sortField[0]);
            $sortField = $sortField[1];
            if (method_exists($this->model, $sortRalation)) {
                $query = $query->whereHas($sortRalation, function ($query) use ($params, $sortField) {
                    $query->orderBy($sortField, $params['sortOrder']);
                });
            } else {
                $query = $query->orderBy($params['sortField'], $params['sortOrder']);
            }
        } else {
            $query = $query->orderBy($params['sortField'], $params['sortOrder']);
        }

        // Searching
        if (isset($params['searchKeyword']) && $params['searchKeyword']) {
            $removeFields = ['id', 'created_at', 'updated_at'];
            $searchFields = array_diff($columns, $removeFields);
            $query = $query->whereLike($searchFields, $params['searchKeyword']);
            // Search in relations
            foreach ($this->getIndexWiths() as $with) {
                $searchRelation = null;
                $searchFields = null;
                // If with contains selection constraint then only search in selected fields. If not then seach in all fields of relation.
                if ($this->str->contains($with, ':')) {
                    $relation = explode(':', $with);
                    $searchRelation = $relation[0];
                    $searchFields = explode(',', $relation[1]);
                } else {
                    $searchRelation = $with;
                    $searchFields = $this->getModel()->$searchRelation()->getModel()->getConnection()->getSchemaBuilder()->getColumnListing($this->getModel()->getTable());
                }
                $searchFields = array_diff($searchFields, $removeFields);

                $query = $query->orWhereHas($searchRelation, function ($query) use ($params, $searchFields) {
                    $query->where(function ($query) use ($params, $searchFields) {
                        $query->whereLike($searchFields, $params['searchKeyword']);
                    });
                });
            }
        }

        // Column Filter
        if (isset($params['filterdatafield0']) && $params['filterdatafield0']) {
            $filters = [];
            $currentField = 0;
            while (true) {
                if (isset($params["filterdatafield{$currentField}"]) && $params["filterdatafield{$currentField}"]) {
                    if (array_search($params["filterdatafield{$currentField}"], $columns) != false) {
                        $filter = [];
                        $filter['name'] = $params["filterdatafield{$currentField}"];
                        if (isset($params["filtercondition{$currentField}"]) && $params["filtercondition{$currentField}"]) {
                            $filter['condition'] = $params["filtercondition{$currentField}"];
                            $filter['value'] = isset($params["filtervalue{$currentField}"]) ? $params["filtervalue{$currentField}"] : '';
                            array_push($filters, $filter);
                        }
                    }
                    $currentField++;
                } else {
                    break;
                }
            }
            foreach ($filters as $filter) {
                switch ($filter['condition']) {
                    case 'NOT_NULL':
                        $query = $query->whereNotNull($filter['name']);
                        break;
                    case 'NULL':
                        $query = $query->whereNull($filter['name']);
                        break;
                    case 'EMPTY':
                        $query = $query->where($filter['name'], '=', '');
                        break;
                    case 'NOT_EMPTY':
                        $query = $query->where($filter['name'], '<>', '');
                        break;
                    case 'CONTAINS':
                        $query = $query->where($filter['name'], 'LIKE', "%{$filter['value']}%");
                        break;
                    case 'CONTAINS_CASE_SENSITIVE':
                        $query = $query->where($filter['name'], 'LIKE BINARY', "%{$filter['value']}%");
                        break;
                    case 'DOES_NOT_CONTAIN':
                        $query = $query->where($filter['name'], 'NOT LIKE', "%{$filter['value']}%");
                        break;
                    case 'DOES_NOT_CONTAIN_CASE_SENSITIVE':
                        $query = $query->whereRaw("`{$filter['name']}` NOT LIKE BINARY '%{$filter['value']}%'");
                        break;
                    case 'EQUAL':
                        $query = $query->where($filter['name'], '=', $filter['value']);
                        break;
                    case 'EQUAL_CASE_SENSITIVE':
                        $query = $query->whereRaw("`{$filter['name']}` = BINARY '{$filter['value']}'");
                        break;
                    case 'STARTS_WITH':
                        $query = $query->where($filter['name'], 'LIKE', "{$filter['value']}%");
                        break;
                    case 'STARTS_WITH_CASE_SENSITIVE':
                        $query = $query->where($filter['name'], 'LIKE BINARY', "{$filter['value']}%");
                        break;
                    case 'ENDS_WITH':
                        $query = $query->where($filter['name'], 'LIKE', "%{$filter['value']}");
                        break;
                    case 'ENDS_WITH_CASE_SENSITIVE':
                        $query = $query->where($filter['name'], 'LIKE BINARY', "%{$filter['value']}");
                        break;
                }
            }

            // Search in relations
            // foreach ($this->getIndexWiths() as $with) {
            //     $searchRelation = null;
            //     $searchFields = null;
            //     // If with contains selection constraint then only search in selected fields. If not then seach in all fields of relation.
            //     if ($this->str->contains($with, ':')) {
            //         $relation = explode(':', $with);
            //         $searchRelation = $relation[0];
            //         $searchFields = explode(',', $relation[1]);
            //     } else {
            //         $searchRelation = $with;
            //         $searchFields = $this->getModel()->$searchRelation()->getModel()->getConnection()->getSchemaBuilder()->getColumnListing($this->getModel()->getTable());
            //     }
            //     $searchFields = array_diff($searchFields, $removeFields);

            //     $query = $query->orWhereHas($searchRelation, function ($query) use ($params, $searchFields) {
            //         $query->where(function ($query) use ($params, $searchFields) {
            //             $query->whereLike($searchFields, $params['searchKeyword']);
            //         });
            //     });
            // }
        }

        // Pagination
        if ($params['perPage'] == -1) {
            $perPage = $query->count();
        } else {
            $perPage = $params['perPage'];
        }
        $items = $query->paginate($perPage);

        return $items;
    }

    /**
     * Get the list of columns to fetch in index.
     *
     * @return array
     */
    public function getIndexColumns()
    {
        $columns = null;
        if ($this->indexColumns) {
            $columns = $this->indexColumns;
        } else {
            // Fetch all columns from table of model.
            $columns = $this->getModel()->getConnection()->getSchemaBuilder()->getColumnListing($this->getModel()->getTable());
        }
        // Filter columns
        if ($this->exceptIndexColumns) {
            $columns = array_diff($columns, $this->getExceptIndexColumns());
        }
        return $columns;
    }

    /**
     * Set the list of columns to fetch in index.
     *
     * @param  array $columns
     * @return $this
     */
    public function setIndexColumns(array $columns)
    {
        $this->indexColumns = $columns;
    }

    /**
     * Get the list of columns to fetch in index.
     *
     * @return array
     */
    public function getExceptIndexColumns()
    {
        if ($this->exceptIndexColumns) {
            return $this->exceptIndexColumns;
        } else {
            return [];
        }
    }

    /**
     * Set the list of columns to fetch in index.
     *
     * @param  array $columns
     * @return $this
     */
    public function setExceptIndexColumns(array $columns)
    {
        $this->exceptIndexColumns = $columns;
    }

    /**
     * Get the list of relationship to eagar load in index.
     *
     * @return array
     */
    public function getIndexWiths()
    {
        if ($this->indexWiths) {
            return $this->indexWiths;
        } else {
            return [];
        }
    }

    /**
     * Set the list of relationship to eagar load in index.
     *
     * @param  array $with
     * @return $this
     */
    public function setIndexWiths(array $withs)
    {
        $this->indexWiths = $withs;
    }
}
