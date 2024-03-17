<?php

namespace App\Services\User\UseCases;

use App\Models\Subscribes;
use App\Repositories\Read\BotText\BotTextReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dtos\UserDto;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class UnSubscribeUserUseCase extends AbstractBot
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

        if (!is_null($user) && !is_null($user->subscribes)) {
            $subscribeId = $user->subscribes->id;

            Subscribes::query()->where('id', $subscribeId)->delete();

            $text = $this->botTextReadRepository->getBySlug('your_subscription_has_been_removed')->text;
            $this->sendMessage($dto->telegramId, $text);

            return;
        }

        $text = $this->botTextReadRepository->getBySlug('you_are_not_subscribed')->text;
        $this->sendMessage($dto->telegramId, $text);
    }
}
