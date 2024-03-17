<?php

namespace App\Services\BotText\Actions;

use App\Repositories\Read\BotText\BotTextReadRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class IndexBotTextAction
{
    public function __construct(
        protected BotTextReadRepositoryInterface $botTextReadRepository
    ) {
    }

    public function run(): Collection
    {
        return $this->botTextReadRepository->index();
    }
}
