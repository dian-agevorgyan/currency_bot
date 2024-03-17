<?php

namespace App\Services\User\UseCases;

use App\Services\User\Dtos\UserDto;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class StartUseCase extends AbstractBot
{
    /**
     * @throws TeleBotException
     */
    public function run(UserDto $dto): bool
    {
        //TODO Эти строки тоже можно сделать динамический, но это будет отнимать много времени. В качестве примера я создал несколько из них динамический.

        $greetingText = "<b>Добро пожаловать!\n\n</b>";
        $greetingText .= 'Для просмотра доступных команд введите /help';
        $exchangeRateText = '<i>Пример:</i> Текущий обменный курс <b>1</b> USD к RUB составляет <b>92.87264</b>';

        $histories = "<i>Пример: \n</i>";
        $histories .= "<b>ID</b>: 3 \n";
        $histories .= "<b>User ID</b>: 24\n";
        $histories .= "<b>Message</b>: Text\n";
        $histories .= "<b>Message ID</b>: 89\n";
        $histories .= "<b>Created</b>: 1970-01-01 00:00:00";

        $this->sendMessage($dto->telegramId, $greetingText, 'HTML');
        $this->sendMessage($dto->telegramId, $exchangeRateText, 'HTML');
        $this->sendMessage($dto->telegramId, $histories, 'HTML');

        return true;
    }
}
