<?php

namespace App\Services\User\Actions;

use App\Models\Histories;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dtos\UserDto;
use App\Services\User\UseCases\GetCurrencyUseCase;
use App\Services\User\UseCases\GetHistoryUseCase;
use App\Services\User\UseCases\GetUserUseCase;
use App\Services\User\UseCases\HelpUseCase;
use App\Services\User\UseCases\OtherCommandUseCase;
use App\Services\User\UseCases\RegisterUserUseCase;
use App\Services\User\UseCases\StartUseCase;
use App\Services\User\UseCases\SubscribeUserUseCase;
use App\Services\User\UseCases\UnSubscribeUserUseCase;
use GuzzleHttp\Exception\GuzzleException;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class UserAction
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository,
        protected RegisterUserUseCase $registerUserUseCase,
        protected GetUserUseCase $getUserUseCase,
        protected GetCurrencyUseCase $getCurrencyUseCase,
        protected GetHistoryUseCase $getHistoryUseCase,
        protected SubscribeUserUseCase $subscribeUserUseCase,
        protected UnSubscribeUserUseCase $unSubscribeUserUseCase,
        protected StartUseCase $startUseCase,
        protected HelpUseCase $helpUseCase,
        protected OtherCommandUseCase $otherCommandUseCase
    ) {
    }

    /**
     * @throws TeleBotException
     * @throws GuzzleException
     */
    public function run(UserDto $dto): void
    {
        $user = $this->userReadRepository->getByTelegramId($dto);

        if (!is_null($user)) {
            $history = Histories::staticCreate($dto, $user->id);
            $history->save();
        }

        match ($dto->message) {
            '/start' => $this->startUseCase->run($dto),
            '/register' => $this->registerUserUseCase->run($dto),
            '/get' => $this->getUserUseCase->run($dto),
            '/currency' => $this->getCurrencyUseCase->run($dto),
            '/histories' => $this->getHistoryUseCase->run($dto),
            '/subscribe' => $this->subscribeUserUseCase->run($dto),
            '/unsubscribe' => $this->unSubscribeUserUseCase->run($dto),
            '/help' => $this->helpUseCase->run($dto),
            default => $this->otherCommandUseCase->run($dto)
        };
    }
}
