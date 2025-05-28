<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_name',
        'course',
        'year',
        'suffix',
        'curator_id',
    ];

    /**
     * Get the group name component.
     */
    public function nameComponent(): BelongsTo
    {
        return $this->belongsTo(GroupNameComponent::class, 'name_component_id');
    }

    /**
     * Получить куратора группы.
     */
    public function curator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'curator_id');
    }

    /**
     * Получить студентов группы.
     */
    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'group_id');
    }

    /**
     * Get the subjects and teachers associated with the group.
     */
    public function subjectsAndTeachers(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher_group', 'group_id', 'subject_id')
                    ->withPivot('user_id'); // Включаем поле user_id из промежуточной таблицы (преподаватель)
    }
}
