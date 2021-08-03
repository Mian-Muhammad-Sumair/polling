<?php


namespace App\Providers;


use App\CRUD\Repositories\BaseCRUDRepository;
use App\CRUD\Repositories\BaseCRUDRepositoryInterface;
use App\Repositories\PollRepository;
use App\Repositories\PollRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            BaseCRUDRepositoryInterface::class,
            BaseCRUDRepository::class
        );
        $this->app->bind(
            PollRepositoryInterface::class,
            PollRepository::class
        );
    }
}
