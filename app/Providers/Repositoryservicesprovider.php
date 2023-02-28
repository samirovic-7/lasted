<?php

namespace App\Providers;

use App\Repository\DBrepositoryplan;
use App\Repository\DBrepositoryfeature;
use Illuminate\Support\ServiceProvider;
use App\Repository\Rooms\DBrepositoryRoom;
use App\Repositoryinterface\Repositoryplaninterface;
use App\Repositoryinterface\Repositoryfeatureinterface;
use App\Repositoryinterface\Rooms\RepositoryRoomInterface;
use App\Repository\profiles\guestProfile\DBrepositoryGuestInhouse;
use App\Repository\profiles\guestProfile\DBrepositoryGuestPrpfile;
use App\Repositoryinterface\Profiles\GuestProfile\RepositoryGuestInhouseInterface;
use App\Repositoryinterface\Profiles\GuestProfile\RepositoryGuestProfileInterface;



class Repositoryservicesprovider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Repositoryplaninterface::class, DBrepositoryplan::class);
        $this->app->bind(Repositoryfeatureinterface::class, DBrepositoryfeature::class);
        $this->app->bind(RepositoryRoomInterface::class,DBrepositoryRoom::class);
        $this->app->bind(RepositoryGuestProfileInterface::class,DBrepositoryGuestPrpfile::class);
        $this->app->bind(RepositoryGuestInhouseInterface::class,DBrepositoryGuestInhouse::class);
    }
}
