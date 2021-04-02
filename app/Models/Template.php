<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Orchid\Screen\AsSource;

    class Template extends Model {
        use AsSource;

        protected $table = 'templates';
        protected $fillable = [
            'name',
            'subject',
            'head',
            'content',
            'mailable_path',
            'type_id',
            'header_id',
            'footer_id',
        ];
        protected $hidden = [];

        public function type () {
            return $this->belongsTo (TemplateType::class);
        }

        public function header () {
            return $this->belongsTo (Template::class, 'header_id', 'id');
        }

        public function footer () {
            return $this->belongsTo (Template::class, 'footer_id', 'id');
        }

        /**
         * @param Builder $query
         *
         * @return Builder
         */
        public function scopeHeaderList (Builder $query) {
            $categoryHeader = TemplateType::where ('name', 'Header')->first ();
            return $query->where ('type_id', $categoryHeader->id);
        }

        public function scopeFooterList (Builder $query) {
            $categoryFooter = TemplateType::where ('name', 'Footer')->first ();
            return $query->where ('type_id', $categoryFooter->id);
        }

    }
