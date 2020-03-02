<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $fillable = [
    	'logo',
    	'header',
    	'background1',
        'title1',
    	'background2',
        'title2',
    	'background3',
        'title3',
    	'content1',
        'subject1',
    	'content2',
        'subject2',
    	'content3',
        'subject3',
        'newsfeeds',
    	'footer'
    ];
}
