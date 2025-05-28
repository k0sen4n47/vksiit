<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
        'role',
        'group_id',
        'fio',
    ];

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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the subjects and groups the user (teacher) is associated with.
     */
    public function subjectsAndGroups(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher_group', 'user_id', 'subject_id')
                    ->withPivot('group_id'); // Включаем поле group_id из промежуточной таблицы
    }

    /**
     * Получить группу, к которой относится пользователь (если он студент).
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Получить группу, куратором которой является пользователь (если он преподаватель).
     */
    public function isCurator(): HasOne
    {
        return $this->hasOne(Group::class, 'curator_id');
    }
}
