<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addYears(1));
        // if (! $this->app->routesAreCached()) {
        //     Passport::routes();
        // }
        //
        //------------------ Quyền Nhập liệu báo cáo -------------------
        Gate::define('browse_nhaplieu-baocao', function ($user) {
            return $user->hasPermission('browse_nhaplieu-baocao');
        });
        Gate::define('add_nhaplieu-baocao', function ($user) {
            return $user->hasPermission('add_nhaplieu-baocao');
        });
        Gate::define('edit_nhaplieu-baocao', function ($user) {
            return $user->hasPermission('edit_nhaplieu-baocao');
        });
        Gate::define('delete_nhaplieu-baocao', function ($user) {
            return $user->hasPermission('delete_nhaplieu-baocao');
        });

        //------------------ Quyền Thông báo -------------------
        Gate::define('browse_thong-bao', function ($user) {
            return $user->hasPermission('browse_thong-bao');
        });
        Gate::define('add_thong-bao', function ($user) {
            return $user->hasPermission('add_thong-bao');
        });
        Gate::define('edit_thong-bao', function ($user) {
            return $user->hasPermission('edit_thong-bao');
        });
        Gate::define('send_thong-bao', function ($user) {
            return $user->hasPermission('send_thong-bao');
        });
        Gate::define('delete_thong-bao', function ($user) {
            return $user->hasPermission('delete_thong-bao');
        });
         //------------------ Báo cáo số liệu -------------------
         Gate::define('browse_xem-nhaplieu-baocao', function ($user) {
            return $user->hasPermission('browse_xem-nhaplieu-baocao');
        });

        Gate::define('browse_khao-sat', function ($user) {
            return $user->hasPermission('browse_khao-sat');
        });

        Gate::define('edit_khao-sat', function ($user) {
            return $user->hasPermission('edit_khao-sat');
        });
         //------------------ Báo cáo tổng hợp khảo sát-------------------
         Gate::define('browse_baocao-tonghop-khaosat', function ($user) {
            return $user->hasPermission('browse_baocao-tonghop-khaosat');
        });
        Gate::define('add_ketqua_hotro_huongdan_motcua', function ($user) {
            return $user->hasPermission('add_ketqua_hotro_huongdan_motcua');
        });
        Gate::define('edit_ketqua_hotro_huongdan_motcua', function ($user) {
            return $user->hasPermission('edit_ketqua_hotro_huongdan_motcua');
        });
        Gate::define('delete_ketqua_hotro_huongdan_motcua', function ($user) {
            return $user->hasPermission('delete_ketqua_hotro_huongdan_motcua');
        });
    }
}
