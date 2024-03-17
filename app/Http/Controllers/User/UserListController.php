<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Read\User\UserReadRepositoryInterface;

class UserListController extends Controller
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository
    ) {
    }

    public function __invoke()
    {
        $users = $this->userReadRepository->index();

        return view('admin.userList', compact('users'));
    }
}
