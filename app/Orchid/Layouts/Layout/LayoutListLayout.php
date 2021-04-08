<?php

namespace App\Orchid\Layouts\Layout;

use App\Models\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LayoutListLayout extends Table {
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'layouts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array {
        return [
            TD::make('name')->render(function(Layout $layout) {
                return Link::make($layout->name)->route('platform.layouts.edit', $layout);
            }),
            TD::make('created_at')->render(function(Layout $layout) {
                return $layout->created_at->format('d/m/Y H:i');
            }),
        ];
    }
}
