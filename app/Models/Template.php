<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Template extends Model {
    use AsSource, Filterable;

    protected $table = 'templates';
    protected $fillable = [
        'name',
        'subject',
        'head',
        'content',
        'secret_api',
        'mailable_path',
        'category_id',
        'layout_id',
    ];
    protected $hidden = [];
    protected $allowedFilters = [
        'name',
        'subject',
        'category_id',
        'created_at',
    ];
    protected $allowedSorts = [
        'name',
        'subject',
        'category_id',
        'created_at',
    ];

    public function attachments() {
        return $this->hasMany(Attachment::class, 'template_id', 'id');
    }

    public function type() {
        return $this->belongsTo(TemplateType::class);
    }

    public function category() {
        return $this->belongsTo(TemplateCategory::class);
    }

    public function layout() {
        return $this->belongsTo(Layout::class, 'layout_id', 'id');
    }
}
