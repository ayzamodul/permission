<?php

namespace Modul\Permission\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../views', 'permission');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config/permission.php', 'permission');
        $this->publishes([__DIR__ . '/../config/permission.php' => config_path('app.php')], 'config');

        $data = [
            'baslik' => 'Yetkilendirme',
            'url' => '/yonetim/permission',
            'aktif_mi' => 1
        ];
        $count = DB::table('moduller')->where('Baslik', 'Yetkilendirme')->count();
        if ($count == 0) {
            DB::table('moduller')->insert($data);
        } else {
            return false;
        }
     

    }

    public function register()
    {

    }
}
