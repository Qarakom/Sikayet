<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Operator;

class Sikayet extends Model
{
    use HasFactory;

    protected $table = 'sikayet';

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    protected $fillable = [
        'sikayetci','operator_id', 'movzu', 'metn', 'fayllar',
    ];



    public function sikayetcil()
    {
        return $this->belongsTo(User::class,'sikayetci');
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class,'operator_id');
    }
}
