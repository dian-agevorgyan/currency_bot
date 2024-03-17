<?php

namespace App\Models;

use App\Services\User\Dtos\UserDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Histories
 *
 * @property string $user_id;
 * @property string $message;
 * @property string $message_id;
 *
 */

class Histories extends Model
{
    use HasFactory;

    public static function staticCreate(UserDto $dto, string $userId): Histories
    {
        $history = new Histories();

        $history->setUserId($userId);
        $history->setMessage($dto->message);
        $history->setMessageId($dto->messageId);

        return $history;
    }

    public function setUserId(string $userId): void
    {
        $this->user_id = $userId;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setMessageId(string $messageId): void
    {
        $this->message_id = $messageId;
    }
}
