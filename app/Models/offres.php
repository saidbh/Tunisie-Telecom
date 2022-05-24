<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offres extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'offres';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'offre_type_id',
        'offre_commercial_id',
        'objectif_types_id',
        'departements_id',
        'documents_id',
        'objectif_date',
        'objectifs',
        'created_at',
        'updated_at',
    ];
    public function DataOffre()
    {
        return $this->hasOne(DataOffres::class,'offres_id','id');
    }
    public function ObjectifType()
    {
        return $this->hasOne(ObjectifTypes::class,'id','objectif_types_id');
    }
    public function OffreType()
    {
        return $this->hasOne(OffreType::class,'id','offre_type_id');
    }
    public function CommercialOffre()
    {
        return $this->hasOne(OffreCommercial::class,'id','offre_commercial_id');
    }
}
