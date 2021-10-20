<?php


namespace App\Providers;


use App\CRUD\Repositories\BaseCRUDRepository;
use App\CRUD\Repositories\BaseCRUDRepositoryInterface;
use App\Repositories\ContactUsRepositoryInterface;
use App\Repositories\ContactUsRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\PermissionRepositoryInterface;
use App\Repositories\PollRepository;
use App\Repositories\PollRepositoryInterface;
use App\Repositories\RoleRepository;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\SubscribeRepository;
use App\Repositories\SubscribeRepositoryInterface;
use App\Repositories\SubscriptionPlanRepository;
use App\Repositories\SubscriptionPlanRepositoryInterface;
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
        $this->app->bind(
            PermissionRepositoryInterface::class,
            PermissionRepository::class
        );
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );
        $this->app->bind(
            ContactUsRepositoryInterface::class,
            ContactUsRepository::class
        );
        $this->app->bind(
            SubscribeRepositoryInterface::class,
            SubscribeRepository::class
        );
        $this->app->bind(
            SubscriptionPlanRepositoryInterface::class,
            SubscriptionPlanRepository::class
        );
    }
}
