<?php

namespace App\Models\Db;

use App\Models\Db\User;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Db\Project
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Db\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Db\Project whereUserId($value)
 * @mixin \Eloquent
 */
class Project extends Model
{

    const STATUS_PLANNED = 'planned';

    const STATUS_RUNNING = 'running';

    const STATUS_FINISHED = 'finished';

    const STATUS_CANCEL = 'cancel';

    const PROJECT_STATUSES = [
        self::STATUS_CANCEL,
        self::STATUS_FINISHED,
        self::STATUS_PLANNED,
        self::STATUS_RUNNING
    ];

    protected $hidden = ['statuses'];

    /**
     * @var array
     */
    protected $appends = ['statuses'];

    protected $with = ['user:id,first_name,last_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array
     */
    public function getStatusesAttribute()
    {
        return self::PROJECT_STATUSES;
    }

}
