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
        'A02'
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
            throw new \Exception('提供的路徑無router檔案可載入!');
        }
{
    name:
    path:
    children: [{
        
    }]
}
        /**
         * 載入各系統的web、api
         */
        foreach (self::MODULES as $sysPath) {
            $rootSys   = base_path("Modules\\${schoolNo}\\${sysPath}");
            $routePath = $rootSys . '\\Routes';

            if (is_dir($routePath)) {
                $namespace = "Modules\\${schoolNo}\\${sysPath}\\Http\\Controllers";

                // 如果無該資料夾，則直接略過
                if (!is_dir($routePath)) {
                    continue;
                }
                $this->routes(function () use ($routePath, $namespace, $sysPath, $schoolNo) {
                    Route::prefix('api')
                        ->namespace($namespace)
                        ->group($routePath . '/api.php');
                    Route::middleware('web')
                        ->namespace($namespace)
                        ->group($routePath . '/web.php');

                    // 載入view路徑，並設定別名
                    $this->loadViewsFrom(base_path("Modules/${schoolNo}/${sysPath}/Resources/views/"), "${schoolNo}_${sysPath}");
                });

            }
        }

        $this->app->bind(FormServiceInterFace::class, function ($app) use ($schoolNo) {
            $school_no = $schoolNo;

            $action = request()->route()->getAction();

            $namespace = $action['namespace'] . '\\';

            $controller  = explode('\\', $action['controller']);
            $ServiceName = explode('Controller', 'App\Service\\' . $school_no . '\\' . $controller[4] . '\\' . $controller[5])[0] . 'Service';
//            dd($ServiceName);
            if (class_exists($ServiceName)) {
                return $app->make($ServiceName);
            }
        });

        // $this->app->bind(FormRequest::class, function ($app) {
        //     $school_no = config('app.school_no') == '' ? 'BASE' : config('app.school_no');

        //     $action = request()->route()->getAction();

        //     $namespace = $action['namespace'] . '\\';

        //     $controller = explode('\\', $action['controller']);

        //     $ServiceName = explode('Controller', 'App\Http\Requests\\' . $controller[5])[0] . 'FormRequest';
        //     if (class_exists($ServiceName)) {
        //         return $app->make($ServiceName);
        //     }
        // });

    }
}
