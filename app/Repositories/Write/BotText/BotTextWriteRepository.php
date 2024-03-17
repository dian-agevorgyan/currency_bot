<?php

namespace App\Repositories\Write\BotText;

use App\Models\BotTexts;
use Illuminate\Database\Eloquent\Builder;

class BotTextWriteRepository implements BotTextWriteRepositoryInterface
{
    private function query(): Builder
    {
        return BotTexts::query();
    }
}
