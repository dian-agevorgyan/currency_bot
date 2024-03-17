<?php

namespace App\Services\BotText\Actions;

use App\Repositories\Read\BotText\BotTextReadRepositoryInterface;

class EditBotTextAction
{
    public function __construct(
        protected BotTextReadRepositoryInterface $botTextReadRepository
    ) {
    }

    public function run(int $id)
    {
        return $this->botTextReadRepository->getById($id);
    }
}
