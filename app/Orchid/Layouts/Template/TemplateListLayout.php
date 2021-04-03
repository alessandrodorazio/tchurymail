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
    protected function columns (): array {
        return [
            TD::make ('name', 'Name')->render (function (Template $template) {
                return Link::make ($template->name)->route ('platform.templates.edit', $template);
            }),
            TD::make ('category.name', 'Category'),
            TD::make ('subject', 'Subject'),
            TD::make ('type.name', 'Template type'),

        ];
    }
}
