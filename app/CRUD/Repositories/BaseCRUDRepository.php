<?php

#                             ::Using Note::
#  Before Using this  Bing BaseCRUDRepository  in you RepositoryServiceProvider

#  $this->app->bind(
#   BaseCRUDRepositoryInterface::class,
#   BaseCRUDRepository::class
#  );

#  For PaginateTrait to work properly add this marcro in AppServiceProvider Boot

#  Builder::macro('whereLike', function ($attributes, string $searchKeyword) {
#    foreach (Arr::wrap($attributes) as $attribute) {
#        $this->orWhere($attribute, 'LIKE', "%{$searchKeyword}%");
#    }
#    return $this;
#  });


namespace App\CRUD\Repositories;

use App\CRUD\Traits\CreateTrait;
use App\CRUD\Traits\DeleteTrait;
use App\CRUD\Traits\GetTrait;
use App\CRUD\Traits\PaginateTrait;
use App\CRUD\Traits\RelatedTrait;
use App\CRUD\Traits\TimelineTrait;
use App\CRUD\Traits\UpdateTrait;
use Illuminate\Support\Str;


class BaseCRUDRepository implements BaseCRUDRepositoryInterface
{
    use PaginateTrait, RelatedTrait, GetTrait, TimelineTrait, CreateTrait, UpdateTrait, DeleteTrait;

    /**      
     * The model associated with the repository.
     * 
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**      
     * @var Illuminate\Support\Str
     */
    public $str;

    /**      
     * Repository constructor.      
     *      
     * @param Str $model      
     */
    public function __construct(Str $str)
    {
        $this->str = $str;
        $this->setup();
    }

    public function setup()
    {
    }

    /**
     * Get the model associated with the repository.
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        if ($this->model) {
            return $this->model;
        } else {
            $reflector = new \ReflectionClass($this);
            $namespace = str_replace('Repositories', 'Models\\', $reflector->getNamespaceName()); // Namespace of Model directory
            $class = substr(class_basename($this), 0, -10);    // Remove word Repository
            $this->setModel($namespace . $class);
            return $this->getModel();
        }
    }

    /**
     * Set the model associated with the repository.
     * @param string $model
     */
    public function setModel(string $model)
    {
        $this->model = resolve($model);
    }
}
