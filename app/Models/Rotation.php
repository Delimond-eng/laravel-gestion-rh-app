<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rotation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rotations';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'equipe_id',
        'agent_id',
        'jours',
        'user_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_creation'=>'datetime:d/m/Y H:i'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date_creation'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Relation agent
     * @return BelongsTo
     */
    public function agent():BelongsTo
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    /**
     * Relation equipe
     * @return BelongsTo
     */
    public function equipe():BelongsTo
    {
        return $this->belongsTo(Equipe::class, 'equipe_id');
    }

    /**
     * Relation user
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*public function getJoursAttribute($value): array
    {
        return explode(',', $value);
    }*/

    /*public function setJoursAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['jours'] = implode(',', $value);
        } else {
            $joursArray = explode(',', $value);
            $this->attributes['jours'] = implode(',', $joursArray);
        }
    }*/
}
