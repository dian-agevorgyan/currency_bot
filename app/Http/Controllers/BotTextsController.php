<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBotTextRequest;
use App\Models\BotTexts;
use App\Services\BotText\Actions\EditBotTextAction;
use App\Services\BotText\Actions\IndexBotTextAction;
use App\Services\BotText\Actions\UpdateBotTextAction;
use App\Services\BotText\Dto\UpdateBotTextDto;
use Illuminate\Http\RedirectResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class BotTextsController extends Controller
{
    public function __construct(
        protected IndexBotTextAction $indexBotTextAction,
        protected EditBotTextAction $editBotTextAction,
        protected UpdateBotTextAction $updateBotTextAction
    ) {
    }

    public function index()
    {
        $texts = $this->indexBotTextAction->run();

        return view('admin.bot_texts.index', compact('texts'));
    }

    public function edit($text)
    {
        $text = $this->editBotTextAction->run($text);

        return view('admin.bot_texts.edit', compact('text'));
    }

    /**
     * @throws UnknownProperties
     */
    public function update(UpdateBotTextRequest $request, BotTexts $bot_text): RedirectResponse
    {
        $dto = UpdateBotTextDto::fromRequest($request);

        $this->updateBotTextAction->run($dto, $bot_text);

        return redirect()->route('bot_texts.index');
    }
}
