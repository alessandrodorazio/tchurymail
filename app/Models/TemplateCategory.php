<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class TemplateCategory extends Model {
    use HasFactory, AsSource;

    public $fillable = ['name'];

    public function templates () {
        return $this->hasMany (Template::class, 'category_id', 'id');
    }
}
