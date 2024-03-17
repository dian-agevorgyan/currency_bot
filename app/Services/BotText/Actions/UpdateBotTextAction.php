<?php

namespace App\Services\BotText\Actions;

use App\Models\BotTexts;
use App\Repositories\Read\BotText\BotTextReadRepositoryInterface;
use App\Services\BotText\Dto\UpdateBotTextDto;

class UpdateBotTextAction
{
    public function __construct(
        protected BotTextReadRepositoryInterface $botTextReadRepository
    ) {
    }

    public function run(UpdateBotTextDto $dto, BotTexts $botText): void
    {
        $this->botTextReadRepository->update($botText->id, ['text' => $dto->text]);
    }
}
