<?php

namespace App\Repositories\Read\BotText;

interface BotTextReadRepositoryInterface
{
    public function index();

    public function getById(int $id);

    public function getBySlug(string $slug);

    public function update(int $id, array $data);
}
