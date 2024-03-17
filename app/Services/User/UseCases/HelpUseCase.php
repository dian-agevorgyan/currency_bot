<?php

namespace App\Services\User\UseCases;

use App\Services\User\Dtos\UserDto;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class HelpUseCase extends AbstractBot
{
    /**
     * @throws TeleBotException
     */
    public function run(UserDto $dto): void
    {
        $helpText = "<b>Доступные команды\n\n</b>"
            . "/start - Начать взаимодействие\n"
            . "/register - Зарегистрировать пользователя\n"
            . "/get - Получить информацию о пользователях\n"
            . "/currency - Получить текущий курс валюты\n"
            . "/histories - Показать историю запросов\n"
            . "/subscribe - Подписаться на уведомления\n"
            . "/unsubscribe - Отписаться от уведомлений\n";

        $this->sendMessage($dto->telegramId, $helpText, 'HTML');
    }
}
