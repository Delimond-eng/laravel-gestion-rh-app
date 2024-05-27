<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conge extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'conges';

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
        'conge_date_debut',
        'conge_date_fin',
        'nb_jours',
        'conge_motif',
        'type_id',
        'agent_id',
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
        'conge_date_creation'=>'datetime:d/m/Y H:i',
        'conge_date_debut'=>'datetime:d/m/Y',
        'conge_date_fin'=>'datetime:d/m/Y',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'conge_date_creation'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Voir le type de congé
     * @return BelongsTo
    */
    public function type():BelongsTo
    {
        return $this->belongsTo(CongeType::class, foreignKey: 'type_id');
    }

    /**
     * agent concerné
     * @return BelongsTo
    */
    public function agent():BelongsTo
    {
        return $this->belongsTo(Agent::class, foreignKey: 'agent_id');
    }


    /**
     * Voir utilisateur session
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
