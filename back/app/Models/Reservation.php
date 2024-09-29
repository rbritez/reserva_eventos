<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'space_id',
        'event_name',
        'status',
        'date',
        'start_time',
        'end_time',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo Space
    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public static function forRole(): ?object
    {
        $user = auth()->user();
        if ($user->hasRole(RoleEnum::ADMIN->value)) {
            $reservations = Reservation::with('user', 'space')->get();
        } else {
            $reservations = Reservation::with('user', 'space')->where('user_id', $user->id)->get();
        }
        return $reservations;
    }
}
