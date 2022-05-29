<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityStatistics extends Model
{
    use HasFactory;

            /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quality_statistic';

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
     * @var array
     */
    protected $fillable = [
        'id', 
        'departements_id', 
        'type',
        'start_date',
        'end_date', 
        'dgt_raise', 
        'dgt_raised_actual', 
        'Succession_rate', 
        'Succession_rate_24h',
        'Succession_rate_48h', 
        'Succession_rate_72h', 
        'H48_drg_speed'
    ];
    
}
