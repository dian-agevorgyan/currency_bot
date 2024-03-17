<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\Actions\UserAction;
use App\Services\User\Dtos\UserDto;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class UserController extends Controller
{
    /**
     * @throws UnknownProperties
     * @throws GuzzleException
     * @throws TeleBotException
     */
    public function __invoke(
        Request $request,
        UserAction $userAction
    ): JsonResponse {
        $dto = UserDto::fromRequest($request);

        $userAction->run($dto);

        return $this->response();
    }
}
