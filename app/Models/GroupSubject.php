<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GroupSubject extends Model
{
    use HasFactory;
    protected $fillable = ['subject_id', 'group_id'];


    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function scopeGroupSubjects($query)
    {
        if(getGuard() == 'admin')
        {
            return $query->select([
                'group_subjects.id',
                'subject_id',
                'group_id'
            ]);
        }
        else if(getGuard() == 'teacher')
        {
            return Auth::guard(getGuard())->user()->groupSubjects()->select([
                'group_subjects.id',
                'group_subjects.subject_id',
                'group_subjects.group_id'
            ])->getQuery();
        }
        else if(getGuard() == "student")
        {
            return Auth::guard(getGuard())->user()->groupSubjects()->select([
                'group_subjects.id',
                'group_subjects.subject_id',
                'group_subjects.group_id'
            ])->getQuery();

        }
    }
}
