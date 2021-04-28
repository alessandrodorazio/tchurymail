<?php

namespace App\Orchid\Layouts\Template;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Layouts\Rows;

class EditCodeLayout extends Rows
{
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
    protected function fields(): array
    {
        return [
            Code::make('template.content')->title('Content of the email')->lineNumbers()->language(Code::MARKUP)
                ->help('Tested tags: mj-button, mj-carousel, mj-column, mj-divider, mj-hero, mj-image, mj-section, mj-social, mj-spacer, mj-table, mj-text, mj-wrapper'),
        
        ];
    }
}
