<?php

namespace App\Repositories\Read\BotText;

use App\Models\BotTexts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BotTextReadRepository implements BotTextReadRepositoryInterface
{
    private function query(): Builder
    {
        return BotTexts::query();
    }

    public function index(): Collection
    {
        return $this->query()->get();
    }

    public function getById(int $id): ?BotTexts
    {
        return $this->query()->where('id', $id)->first();
    }

    public function getBySlug(string $slug): ?BotTexts
    {
        return $this->query()->where('slug', $slug)->first(['text']);
    }

    public function update(int $id, array $data): int
    {
        return $this->query()->where('id', $id)->update($data);
    }
}
