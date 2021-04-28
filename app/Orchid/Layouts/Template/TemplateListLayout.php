<?php

namespace App\Orchid\Layouts\Template;

use App\Models\Template;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TemplateListLayout extends Table {
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'templates';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array {
        return [
            TD::make('category.name', 'Category'),
            TD::make('name', 'Name')->sort()->filter(TD::FILTER_TEXT)->render(function(Template $template) {
                return Link::make($template->name)->route('platform.templates.edit', $template);
            }),
            TD::make('subject', 'Subject')->sort(),
            TD::make('created_at', 'Created at')->sort()->render(function(Template $template) {
                return $template->created_at->toDateTimeString();
            }),

        ];
    }
}
