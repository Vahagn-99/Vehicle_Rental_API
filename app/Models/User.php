<?php

namespace App\Models;

use App\Contracts\IRenter;
use App\Models\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements IRenter, JWTSubject
{
    use HasFactory, Notifiable;

    /** @var string */
    public const TABLE_NAME = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts() : array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatus::class,
        ];
    }

    /**
     * Наблюдение за событиями модели.
     *
     * @return void
     */
    public static function booted() : void
    {
        static::created(function (User $user) {
            $balance = new Balance();
            $balance->renter_id = $user->id;

            $balance->save();
        });
    }

    /**
     * Получить баланс арендатора.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance() : HasOne
    {
        return $this->hasOne(Balance::class, 'renter_id');
    }

    /**
     * Получить историю аренд арендатора.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rentalHistory() : HasMany
    {
        return $this->hasMany(RentalHistory::class, 'renter_id');
    }

    /**
     * Получить историю операций арендатора.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function operationsHistory() : HasMany
    {
        return $this->hasMany(TransactionHistory::class, 'renter_id');
    }

    /**
     * Получить аренды арендатора.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rents() : HasMany
    {
        return $this->hasMany(Rent::class, 'renter_id');
    }

    //****************************************************************
    //************************** Support *****************************
    //****************************************************************

    /**
     * Получить идентификатор для JWT.
     *
     * @return int
     */
    public function getJWTIdentifier() : int
    {
        return $this->id;
    }

    /**
     * Получить пользовательские данные для JWT.
     *
     * @return array<string, mixed>
     */
    public function getJWTCustomClaims() : array
    {
        return [];
    }
}
