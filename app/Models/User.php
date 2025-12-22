<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'portal.users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'firstname',
        'lastname',
        'middlename',
        'suffix',
        'gender',
        'campus_id',
        'tenant_id',
        'birthdate',
        'email',
        'isemailverified',
        'email_verified_at',
        'photo',
        'role',
        'status',
        'remarks',
        'password',
        'last_seen',
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
        'isemailverified' => 'boolean',
        'birthdate' => 'date',
        'last_seen' => 'datetime',
    ];

    /**
     * Check if the user has a specific role.
     */
    public function hasRole($role): bool
    {
        return $this->role === $role;
    }
}
