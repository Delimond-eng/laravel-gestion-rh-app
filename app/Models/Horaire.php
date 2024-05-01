<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horaire extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'horaires';

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
        'heure_debut',
        'heure_fin',
        'heure_retard',
        'nbre_retard_notification',
        'direction_id',
        'secretariat_id',
        'ministere_id',
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
     * Voir utilisateur session
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Voir Direction
     * @return BelongsTo
     */
    public function direction():BelongsTo
    {
        return $this->belongsTo(Direction::class, 'direction_id');
    }

    /**
     * Voir Ministere
     * @return BelongsTo
     */
    public function ministere():BelongsTo
    {
        return $this->belongsTo(Ministere::class, 'ministere_id');
    }
}
