<?php

namespace App\Providers\Alltop;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * 載入特定學校專案的Router、View
 *
 * @author LWJ
 * @version v1.0.0
 */
class RegisterSchoolServiceProvider extends ServiceProvider
{
    /**
     * 各系統資料夾名稱
     */
    const MODULES = [
        'A01',
        'A02',
        'A03',
    ];
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $schoolNo = config('Alltop.core.SCHOOL_NO') == '' ? 'BASE' : config('Alltop.core.SCHOOL_NO');

        // 專案資料夾路徑
        $root = base_path("Modules\\${schoolNo}");

        if (!is_dir($root)) {
            throw new \Exception('提供的路徑無法載入!');
        }
        $this->routes(function() use ($schoolNo) {
            /**
             * 載入各系統的web、api
             */
            foreach (self::MODULES as $sysPath) {
                // BASE Route and View
                $this->BaseRoute($sysPath);

                // 載入view路徑，並設定別名
                $this->loadViewsFrom(base_path("Modules/BASE/${sysPath}/Resources/views/"), "BASE_${sysPath}");

                $rootSys   = base_path("Modules\\${schoolNo}\\${sysPath}");
                $routePath = $rootSys . '\\Routes';

                // 如果無該資料夾，則不載入
                if (is_dir($routePath)) {
                    $namespace = "Modules\\${schoolNo}\\${sysPath}\\Http\\Controllers";
                    Route::prefix('api')->namespace($namespace . '\Api')->group($routePath . '/api.php');
                    Route::middleware('web')->namespace($namespace. '\Web')->group($routePath . '/web.php');
                }
            
                // 載入view路徑，並設定別名
                $this->loadViewsFrom(base_path("Modules/${schoolNo}/${sysPath}/Resources/views/"), "${schoolNo}_${sysPath}");
            }
        });

        // Insanace Service Class
        $this->instanceFormInterface($schoolNo);

        $this->instanceFormApiInterface($schoolNo);
    }

    // 載入公版路由
    public function BaseRoute($sysPath) {
        // BASE Route and View
        $rootSys   = base_path("Modules\\BASE\\${sysPath}");
        $routePath = $rootSys . '\\Routes';

        // 如果無該資料夾，則不載入
        if (is_dir($routePath)) {
            Route::prefix('api')->namespace("Modules\\BASE\\${sysPath}\\Http\\Controllers\Api")->group($routePath . '/api.php');
            Route::middleware('web')->namespace("Modules\\BASE\\${sysPath}\\Http\\Controllers\Web")->group($routePath . '/web.php');
        }
    }

    /**
     * Insanace Service Class
     * 
     * @param $schoolNo 學校編號
     * @return service
     */
    public function instanceFormInterface($schoolNo) {
        $this->app->bind('App\Contracts\Service\FormServiceInterFace', function ($app) use ($schoolNo) {

            // 如果不是使用request方式進入網頁，則回傳空的FormService
            if(is_null(request()->route())) {
                return $app->make('App\Service\FormService');
            }

            $action = request()->route()->getAction();
            $namespace = $action['namespace'] . '\\';
           
            /**
             * 0 => "Modules"
             * 1 => "BASE"
             * 2 => "A01"
             * 3 => "Http"
             * 4 => "Controllers"
             * 5 => "Web"
             * 6 => "A01110Controller@index"
             */
            $controller  = explode('\\', $action['controller']);
            // dd($controller);

            $MenuName = explode('Controller', $controller[6]);
            $ServiceName = "Modules\\{$schoolNo}\\{$controller[2]}\\Service\\{$MenuName[0]}\\{$controller[5]}\\{$MenuName[0]}Service";
            
            // dd($ServiceName);
            // dd(class_exists($ServiceName));
            if (class_exists($ServiceName)) {
                return $app->make($ServiceName);
            }
        });
    }

    /**
     * Insanace Api Service Class
     * 
     * @param $schoolNo 學校編號
     * @return service
     */
    public function instanceFormApiInterface($schoolNo) {
        $this->app->bind('App\Contracts\Service\FormApiServiceInterFace', function ($app) use ($schoolNo) {

            // 如果不是使用request方式進入網頁，則回傳空的FormService
            if(is_null(request()->route())) {
                return $app->make('App\Service\FormApiService');
            }

            $action = request()->route()->getAction();
            $namespace = $action['namespace'] . '\\';
            
            $apiVersion = strtoupper(explode('/', $action['prefix'])[1]);
           
            /**
             * 0 => "Modules"
             * 1 => "BASE"
             * 2 => "A01"
             * 3 => "Http"
             * 4 => "Controllers"
             * 5 => "Web"
             * 6 => "A01110Controller@index"
             */
            $controller  = explode('\\', $action['controller']);

            $MenuName = explode('Controller', $controller[6]);
            $ServiceName = "Modules\\{$schoolNo}\\{$controller[2]}\\Service\\{$MenuName[0]}\\{$controller[5]}\\{$apiVersion}\\{$MenuName[0]}ApiService";
            
            // dd($ServiceName);
            // dd(class_exists($ServiceName));
            if (class_exists($ServiceName)) {
                return $app->make($ServiceName);
            }
        });
    }

}