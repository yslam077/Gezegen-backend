<?php

namespace App\Models\Api\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $guarded = [];
    public function flight():BelongsTo{
        return $this->belongsTo(Flight::class);
    }
    public function passenger():BelongsTo{
        return $this->belongsTo(Passenger::class);
    }
}
