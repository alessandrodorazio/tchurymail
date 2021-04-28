<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class TemplateCategory extends Model {
    use HasFactory, AsSource, Filterable;

    public $fillable = ['name'];
    protected $allowedSorts = [
        'name',
    ];

    public function templates() {
        return $this->hasMany(Template::class, 'category_id', 'id');
    }
}
