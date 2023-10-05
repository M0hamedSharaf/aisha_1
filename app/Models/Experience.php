<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'from', 'to', 'teacher_id'];

    // protected $dates = ['from', 'to'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }



    protected function from(): Attribute
    {
        return Attribute::make(
            get: fn ($from) => date('Y-m-d', strtotime($from)),
        );
    }


    protected function to(): Attribute
    {
        return Attribute::make(
            get: fn ($to) => date('Y-m-d', strtotime($to)),
        );
    }

    public function scopeExperiences($query)
    {
        if(getGuard() == 'admin')
        {
            return $query->select([
                'experiences.id',
                'title',
                'from',
                'to',
                'experiences.teacher_id',
            ]);
        }
        else if(getGuard() == 'teacher')
        {
            return $query->where('id', Auth::guard(getGuard())->user()->id) ->select([
                'experiences.id',
                'title',
                'from',
                'to',
                'experiences.teacher_id',
           ]);
        }
        else if(getGuard() == "student")
        {
            return Auth::guard(getGuard())->user()
            ->teacherExperiences()
            ->select([
                'experiences.id',
                'title',
                'from',
                'to',
                'experiences.teacher_id',
           ])->getQuery();
             
        }
    }
}