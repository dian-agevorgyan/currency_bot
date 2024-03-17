<?php

namespace App\Services\User\UseCases;

use WeStacks\TeleBot\Exceptions\TeleBotException;
use WeStacks\TeleBot\TeleBot;

abstract class AbstractBot
{
    /**
     * @throws TeleBotException
     */
    public function sendMessage(string $chatId, string $text, ?string $parseMode = ''): void
    {
        $bot = $this->getBot();

        $bot->sendMessage([
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => $parseMode,
        ]);
    }

    /**
     * @throws TeleBotException
     */
    private function getBot(): TeleBot
    {
        return new TeleBot(config('bot.token'));
    }
}
