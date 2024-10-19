<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BindingProvider extends ServiceProvider
{
    protected $repositories = [
        'ModuleRepository' => 'ModuleRepositoryInterface',
        'PermissionRepository' => 'PermissionRepositoryInterface',
        'RoleRepository' => 'RoleRepositoryInterface',
        'AdminRepository' => 'AdminRepositoryInterface',
        'MemberRepository' => 'MemberRepositoryInterface',
        'PostCatalogueRepository' => 'PostCatalogueRepositoryInterface',
    ];

    protected $services = [
        'ModuleService' => 'ModuleServiceInterface',
        'PermissionService' => 'PermissionServiceInterface',
        'RoleService' => 'RoleServiceInterface',
        'AdminService' => 'AdminServiceInterface',
        'MemberService' => 'MemberServiceInterface',
        'PostCatalogueService' => 'PostCatalogueServiceInterface',
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $repository => $interface) {
            $this->app->bind("App\\Repositories\\Interfaces\\{$interface}", "App\\Repositories\\{$repository}");
        }

        foreach ($this->services as $service => $interface) {
            $this->app->bind("App\\Services\\Interfaces\\{$interface}", "App\\Services\\{$service}");
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}