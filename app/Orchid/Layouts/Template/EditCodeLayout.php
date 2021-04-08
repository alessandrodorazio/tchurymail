<?php

namespace App\Orchid\Layouts\Template;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Layouts\Rows;

class EditCodeLayout extends Rows {
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
        return [
            Code::make('template.content')
                ->title('Content of the email')
                ->lineNumbers()
                ->language(Code::MARKUP)
                ->help('Add your head tags here. Tested tags: mj-attributes, mj-font, mj-preview, mj-style, mj-title'),

        ];
    }
}
