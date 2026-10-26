<?php

namespace App\Models\Api\V1;
use Database\Factories\Api\V1\TicketFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function flight():BelongsTo{
        return $this->belongsTo(Flight::class);
    }
    public function passenger():BelongsTo{
        return $this->belongsTo(Passenger::class);
    }
    protected static function newFactory(): Factory
    {
        return TicketFactory::new();
    }
}
