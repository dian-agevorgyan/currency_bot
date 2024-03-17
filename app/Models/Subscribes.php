<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscribes
 *
 * @property string $user_id;
 * @property Carbon $start_at;
 * @property Carbon $end_at;
 *
 */

class Subscribes extends Model
{
    use HasFactory;

    public static function staticCreate(string $userId, Carbon $endAt): Subscribes
    {
        $subscribe = new Subscribes();

        $subscribe->setUserId($userId);
        $subscribe->setStartAt();
        $subscribe->setEndAt($endAt);

        return $subscribe;
    }

    public function setUserId(string $userId): void
    {
        $this->user_id = $userId;
    }

    public function setStartAt(): void
    {
        $this->start_at = Carbon::now();
    }

    public function setEndAt(Carbon $endAt): void
    {
        $this->end_at = $endAt;
    }
}
