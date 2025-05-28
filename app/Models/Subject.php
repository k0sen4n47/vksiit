<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'abbreviation',
    ];

    /**
     * Get the users (teachers) and groups associated with the subject.
     */
    public function teachersAndGroups(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subject_teacher_group', 'subject_id', 'user_id')
                    ->withPivot('group_id'); // Включаем поле group_id из промежуточной таблицы
    }

    // Можно добавить отдельные связи для удобства, например, только с группами через эту связующую таблицу
    // public function groups(): BelongsToMany
    // {
    //     return $this->belongsToMany(Group::class, 'subject_teacher_group', 'subject_id', 'group_id');
    // }

    // ИЛИ связь только с преподавателями
    // public function teachers(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'subject_teacher_group', 'subject_id', 'user_id');
    // }
}
