<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'avatar', 'book','pages_count'];
    // protected $appends = ['pagesCount'];
    const AVATARS_PATH = 'images/subject/avatars/';

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function ($avatar) {
                if ($avatar && file_exists($this->getAvatarPath())) {
                    return asset(Subject::AVATARS_PATH . $avatar);
                }
                return asset('images/bookCover.jpg');
            },
        );
    }

    function getAvatarPath()
    {
        if ($this->getRawOriginal('avatar')) {
            return public_path(Subject::AVATARS_PATH . $this->getRawOriginal('avatar'));
        }
        return '';
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'subject_id');
    }

    public function groupSubjects()
    {
        return $this->hasMany(GroupSubject::class, 'subject_id');
    }

    protected function book(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => "/files/subjects/" . $value,
        );
    }

    public function directoryName()
    {
        $pathArray = explode('_', $this->getRawOriginal('book'));
        return array_shift($pathArray);
    }

    public function directoryPath()
    {
        return "files/subjects/" . $this->name . "/";
    }

    // public function getPagesCountAttribute()
    // {
    //     return count(glob($this->directoryPath() . "*"));
    // }
}