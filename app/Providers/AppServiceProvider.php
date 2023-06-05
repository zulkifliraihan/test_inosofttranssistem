<?php

namespace App\Providers;

use App\Http\Repository\AuthRepository\AuthInterface;
use App\Http\Repository\AuthRepository\AuthRepository;
use App\Http\Repository\CustomerRepository\CustomerInterface;
use App\Http\Repository\CustomerRepository\CustomerRepository;
use App\Http\Repository\KendaraanRepository\KendaraanInterface;
use App\Http\Repository\KendaraanRepository\KendaraanRepository;
use App\Http\Repository\PenjualanRepository\PenjualanInterface;
use App\Http\Repository\PenjualanRepository\PenjualanRepository;
use App\Http\Repository\StokRepository\StokInterface;
use App\Http\Repository\StokRepository\StokRepository;
use App\Models\Mobil;
use App\Models\Motor;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(KendaraanInterface::class, KendaraanRepository::class);
        $this->app->bind(StokInterface::class, StokRepository::class);
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
        $this->app->bind(PenjualanInterface::class, PenjualanRepository::class);
        $this->app->bind(AuthInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'Mobil' => Mobil::class,
            'Motor' => Motor::class,
        ]);
    }
}
