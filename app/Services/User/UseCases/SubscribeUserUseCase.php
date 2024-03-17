<?php

namespace App\Services\User\UseCases;

use App\Models\Subscribes;
use App\Repositories\Read\BotText\BotTextReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dtos\UserDto;
use Carbon\Carbon;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class SubscribeUserUseCase extends AbstractBot
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository,
        protected BotTextReadRepositoryInterface $botTextReadRepository
    ) {
    }

    /**
     * @throws TeleBotException
     */
    public function run(UserDto $dto): void
    {
        $user = $this->userReadRepository->getByTelegramId($dto, ['subscribes']);

        if (is_null($user)) {
            $text = $this->botTextReadRepository->getBySlug('to_get_started_please_register_command_register')->text;
            $this->sendMessage($dto->telegramId, $text);
        }

        if (!is_null($user->subscribes)) {
            $text = $this->botTextReadRepository->getBySlug('you_already_have_subscription')->text;
            $this->sendMessage($dto->telegramId, $text);

            return;
        }

        $endAt = Carbon::now()->addDays(3);
        $subscribe = Subscribes::staticCreate($user->id, $endAt);
        $subscribe->save();

        $text = $this->botTextReadRepository->getBySlug('you_are_subscribed')->text;
        $this->sendMessage($dto->telegramId, $text);
    }
}
