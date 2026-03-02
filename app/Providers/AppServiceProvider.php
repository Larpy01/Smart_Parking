<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ParkingLocation;
use App\Models\ParkingSlot;
use App\Models\Reservation;
use App\Policies\ParkingLocationPolicy;
use App\Policies\ParkingSlotPolicy;
use App\Policies\ReservationPolicy;
use App\Models\Vehicle;
use App\Policies\VehiclePolicy;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 
     * 
     */

    protected $policies = [
        ParkingLocation::class => ParkingLocationPolicy::class,
        ParkingSlot::class => ParkingSlotPolicy::class,
        Reservation::class => ReservationPolicy::class,
        Vehicle::class => VehiclePolicy::class,
    ];
    
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production') || env('RAILWAY_ENVIRONMENT')) {
            URL::forceScheme('https');
        }
    }
}
