<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Layout extends Model {
    use HasFactory, AsSource;

    protected $table = 'layouts';
    protected $fillable = [
        'name',
        'head',
        'header',
        'footer',
    ];
    protected $hidden = [];
}
