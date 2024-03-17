<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BotTextsTableSeeder extends Seeder
{
    public function run(): void
    {
        $texts = [
            ['id' => 1, 'slug' => 'you_already_have_subscription', 'text' => 'У вас уже есть подписка'],
            ['id' => 2, 'slug' => 'you_are_subscribed', 'text' => 'Вы подписаны'],
            ['id' => 3, 'slug' => 'to_get_started_please_register_command_register', 'text' => 'Для начала, пожалуйста, зарегистрируйтесь. Команда: /register'],
            ['id' => 4, 'slug' => 'your_subscription_has_been_removed', 'text' => 'Ваша подписка удалена'],
            ['id' => 5, 'slug' => 'you_are_not_subscribed', 'text' => 'Вы не подписаны'],
            ['id' => 7, 'slug' => 'this_is_your_first_request_please_register', 'text' => 'Это ваш первый запрос. Для начала, пожалуйста, зарегистрируйтесь'],
            ['id' => 8, 'slug' => 'try_another_command', 'text' => 'Попробуйте другую команду'],
        ];

        DB::table('bot_texts')->insert($texts);
    }
}
