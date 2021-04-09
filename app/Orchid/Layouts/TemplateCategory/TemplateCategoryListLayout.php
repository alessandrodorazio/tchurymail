<?php

namespace App\Orchid\Layouts\TemplateCategory;

use App\Models\TemplateCategory;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TemplateCategoryListLayout extends Table {
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array {
        return [
            TD::make('name')->render(function(TemplateCategory $tc) {
                return Link::make($tc->name)->route('platform.templates.categories.edit', $tc);
            }),
            TD::make('Number of templates')->render(function(TemplateCategory $tc) {
                return $tc->templates()->count();
            }),
            TD::make('')->render(function(TemplateCategory $tc) {
                return Link::make('View templates')
                           ->route('platform.templates.list', ['category' => $tc->name]);
            }),
        ];
    }
}
