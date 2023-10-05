<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['notable_type','notable_id','noteby_type','noteby_id','title','note','type','is_favorite'];

    const NOTE_TYPE = ['personal','work','social','important'];

    public function noteby()
    {
        return $this->morphTo('noteby');
    }
}
