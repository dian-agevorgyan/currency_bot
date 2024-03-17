<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Read\User\UserReadRepositoryInterface;

class UserHistoriesController extends Controller
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository
    ) {
    }

    public function __invoke($userId)
    {
        $user = $this->userReadRepository->findOrFail($userId);
        $histories = $user->histories;

        return view('admin.userHistories', compact('user', 'histories'));
    }
}
