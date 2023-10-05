<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Translatable\HasTranslations;

class Elementor extends Model
{
    use HasTranslations;
    use HasFactory;

    public $translatable = ['name', 'desc'];
    protected $fillable = ['name','desc','img'];

    const IMG_PATH = 'images/elementor/';

    protected function img(): Attribute
    {
        return Attribute::make(
            get: function($img){
                if($img && file_exists($this->getImgPath()))
                {
                    return asset(Elementor::IMG_PATH . $img);
                }
                return '';
            },
        );
    }

    function getImgPath(){
        if($this->getRawOriginal('img'))
        {
            return public_path(Elementor::IMG_PATH . $this->getRawOriginal('img'));
        }
        return '';
    }
}
