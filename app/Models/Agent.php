<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agent extends Model
{
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agents';

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
        "agent_matricule",
        "agent_nom",
        "agent_postnom",
        "agent_prenom",
        "agent_genre",
        "agent_telephone",
        "agent_email",
        "agent_adresse",
        "province_id",
        "ministere_id",
        "secretariat_id",
        "direction_id",
        "division_id",
        "bureau_id",
        "fonction_id",
        "grade_id",
        "user_id",
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
        'agent_date_creation'=>'datetime:d/m/Y H:i'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'agent_date_creation'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Voir la province
     * @return BelongsTo
    */
    public function province() : BelongsTo
    {
        return $this->belongsTo(Province::class, foreignKey: 'province_id');
    }


    /**
     * Voir le ministere
     * @return BelongsTo
    */
    public function ministere() : BelongsTo
    {
        return $this->belongsTo(Ministere::class, foreignKey: 'ministere_id');
    }

    /**
     * Voir le ministere
     * @return BelongsTo
    */
    public function secretariat() : BelongsTo
    {
        return $this->belongsTo(Secretariat::class, foreignKey: 'secretariat_id');
    }

    /**
     * Voir le ministere
     * @return BelongsTo
    */
    public function direction() : BelongsTo
    {
        return $this->belongsTo(Direction::class, foreignKey: 'direction_id');
    }

    /**
     * Voir la division
     * @return BelongsTo
    */
    public function division() : BelongsTo
    {
        return $this->belongsTo(Division::class, foreignKey: 'division_id');
    }

    /**
     * Voir bureau
     * @return BelongsTo
    */
    public function bureau():BelongsTo
    {
        return $this->belongsTo(Bureau::class, foreignKey: 'bureau_id');
    }


    /**
     * Voir Fonction
     * @return BelongsTo
    */
    public function fonction():BelongsTo
    {
        return $this->belongsTo(Fonction::class, foreignKey: 'fonction_id');
    }


    /**
     * Voir grade
     * @return BelongsTo
    */
    public function grade():BelongsTo
    {
        return $this->belongsTo(Grade::class, foreignKey: 'grade_id');
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
