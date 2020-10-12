<?php

namespace App\Models;

use App\Models\Traits\UserMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use HasRoles;
    use HasToken;
    use Notifiable;

    use UserMethod;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function assignedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assignee_id', 'id');
    }

    public function createdTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigner_id', 'id');
    }

    public function completedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'completed_by', 'id');
    }
}
