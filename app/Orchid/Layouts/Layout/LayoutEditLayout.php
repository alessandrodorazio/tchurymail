<?php

namespace App\Orchid\Layouts\Layout;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class LayoutEditLayout extends Rows {
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array {
        $layout = $this->query->get('layout');

        return [
            Input::make('layout.name')->title('Name')->required(),
            Code::make('layout.head')
                ->title('Head')
                ->help('Add your head tags here. Tested tags: mj-attributes, mj-font, mj-preview, mj-style, mj-title'),
            Code::make('layout.header')
                ->title('Header')
                ->help('Tested tags: mj-button, mj-carousel, mj-column, mj-divider, mj-hero, mj-image, mj-section, mj-social, mj-spacer, mj-table, mj-text, mj-wrapper'),

            Code::make('layout.footer')
                ->title('Footer')
                ->help('Tested tags:, mj-button, mj-carousel, mj-column, mj-divider, mj-hero, mj-image, mj-section, mj-social, mj-spacer, mj-table, mj-text, mj-wrapper'),

        ];
    }
}
