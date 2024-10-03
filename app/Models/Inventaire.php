<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'details',
        'date_achat',
        'date_prochain_achat',
        "residence_id"
    ];

    public function resident():BelongsTo
    {
        return $this->belongsTo(Residence::class);
    }
}
