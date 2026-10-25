<?php

namespace App\Models\Api\V1;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function fromAirport():BelongsTo{
        return $this->belongsTo(Airport::class,'from_airport_id');
    }
    public function toAirport():BelongsTo{
        return $this->belongsTo(Airport::class,'to_airport_id');
    }
}
