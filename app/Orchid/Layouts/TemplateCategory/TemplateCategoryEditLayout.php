<?php

namespace App\Orchid\Layouts\TemplateCategory;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class TemplateCategoryEditLayout extends Rows {
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
            Input::make('tc.name')->title('Name')->placeholder('Name your category')->required(),
        ];
    }
}
