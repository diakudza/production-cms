<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'tabNumber',
        'shift_id',
        'avatar',
        'position_id',
        'employmentDate',
        'status',
        'role',
        'phone',
        'description',
        'theme_id',

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
    ];

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * @return mixed
     */
    public function getAdjusterOnly()
    {
        return $this->whereNotIn('position_id', [3, 4, 5])->OrderBy('name')->get();
    }

    public function isAdmin()
    {
        return $this->role === UserRole::ADMIN;
    }

    public function getDaysOnServer()
    {
        $created = new Carbon($this->employmentDate);
        $now = Carbon::now();
        $difference = ($created->diff($now)->days < 1)
            ? '0'
            : $created->diffInDays($now);
        return $difference;
    }

}
