<?php

namespace App\Models\Db;

use App\Models\Db\Project;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\Models\Db\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Db\Project[] $projects
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
