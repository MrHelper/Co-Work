<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'Event';

    protected $fillable = [
    	'Title',
    	'Description',
    	'Image',
    	'Link'
    ];
}
