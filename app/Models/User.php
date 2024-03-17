<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\User\Dtos\UserDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id;
 * @property string $first_name;
 * @property ?string $last_name;
 * @property string $telegram_id;
 * @property ?string $telegram_username;
 * @property string $language_code;
 *
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'telegram_id',
        'telegram_username',
        'language_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function staticCreate(UserDto $dto): User
    {
        $user = new User();

        $user->setFirstName($dto->firstName);
        $user->setLastName($dto->lastName);
        $user->setTelegramId($dto->telegramId);
        $user->setTelegramUsername($dto->telegramUsername);
        $user->setLanguageCode($dto->languageCode);

        return $user;
    }

    public function setFirstName(string $firstName): void
    {
        $this->first_name = $firstName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->last_name = $lastName;
    }

    public function setTelegramId(string $telegramId): void
    {
        $this->telegram_id = $telegramId;
    }

    public function setTelegramUsername(?string $telegramUsername): void
    {
        $this->telegram_username = $telegramUsername;
    }

    public function setLanguageCode(string $languageCode): void
    {
        $this->language_code = $languageCode;
    }

    public function histories(): HasMany
    {
        return $this->hasMany(Histories::class, 'user_id');
    }

    public function subscribes(): HasOne
    {
        return $this->hasOne(Subscribes::class, 'user_id');
    }
}
