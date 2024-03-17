<?php

namespace App\Services\BotText\Dto;

use App\Http\Requests\UpdateBotTextRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UpdateBotTextDto extends DataTransferObject
{
    public string $text;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(UpdateBotTextRequest $request): UpdateBotTextDto
    {
        return new self(
            text: $request->getText()
        );
    }
}
