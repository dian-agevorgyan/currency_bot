<?php

namespace App\Services\User\Dtos;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserDto extends DataTransferObject
{
    public string $firstName;
    public ?string $lastName;
    public string $telegramId;
    public ?string $telegramUsername;
    public string $languageCode;
    public string $message;
    public string $messageId;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(Request $request): UserDto
    {
        return new self(
            firstName: $request['message']['from']['first_name'],
            lastName: $request['message']['from']['last_name'] ?? null,
            telegramId: $request['message']['from']['id'],
            telegramUsername: $request['message']['from']['username'] ?? null,
            languageCode: $request['message']['from']['language_code'],
            message: $request['message']['text'],
            messageId: $request['message']['message_id'],
        );
    }
}
