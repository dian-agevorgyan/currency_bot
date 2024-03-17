<?php

namespace App\Providers;

use App\Repositories\Read\BotText\BotTextReadRepository;
use App\Repositories\Read\BotText\BotTextReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepository;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Write\BotText\BotTextWriteRepository;
use App\Repositories\Write\BotText\BotTextWriteRepositoryInterface;

class RepositoryServiceProvider extends AppServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserReadRepositoryInterface::class,
            UserReadRepository::class
        );

        $this->app->bind(
            BotTextReadRepositoryInterface::class,
            BotTextReadRepository::class
        );

        $this->app->bind(
            BotTextWriteRepositoryInterface::class,
            BotTextWriteRepository::class
        );
    }
}
