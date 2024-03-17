<?php

namespace App\Services\User\UseCases;

use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dtos\UserDto;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class GetCurrencyUseCase extends AbstractBot
{
    const USD = 'USD';
    const RUB = 'RUB';

    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository
    ) {
    }

    /**
     * @throws GuzzleException
     * @throws TeleBotException
     */
    public function run(UserDto $dto): void
    {
        $client = new Client();
        $user = $this->userReadRepository->getByTelegramId($dto, ['subscribes']);

        if (is_null($user) || is_null($user->subscribes)) {
            $text = "Для получения информации о курсе доллара, сначала вы должны подписаться.\nКоманда: /subscribe";
            $this->sendMessage($dto->telegramId, $text);

            return;
        }

        $rateAppId = config('bot.rate_app_id');
        $apiEndpoint = config('currency.url') . self::USD . "?apikey={$rateAppId}";

        try {
            $response = $client->get($apiEndpoint);
            $data = json_decode($response->getBody(), true);

            if (json_last_error() === JSON_ERROR_NONE && isset($data['rates'][self::RUB])) {
                $exchangeRate = $data['rates'][self::RUB];
                $text = "Текущий обменный курс 1" . self::USD . " к " . self::RUB . " составляет {$exchangeRate}";
            } else {
                $text = 'Не удалось получить курс обмена';
            }
            $this->sendMessage($dto->telegramId, $text);
        } catch (Exception) {
            $text = 'Пожалуйста, повторите попытку позже';
            $this->sendMessage($dto->telegramId, $text);
        }
    }
}
