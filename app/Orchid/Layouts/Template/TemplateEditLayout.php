<?php

namespace App\Orchid\Layouts\Template;

use App\Models\Layout;
use App\Models\TemplateCategory;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class TemplateEditLayout extends Rows {
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
        $template = $this->query->get('template');

        return [
            Input::make('template.name')->title('Name')->placeholder('What is the name of this email?')->required(),

            Input::make('template.subject')
                 ->title('Subject')
                 ->placeholder('The subject of the email')->required()
            ,

            Relation::make('template.category_id')
                    ->title('Category')
                    ->fromModel(TemplateCategory::class, 'name'),

            Relation::make('template.layout_id')
                    ->title('Layout*')
                    ->required()
                    ->fromModel(Layout::class, 'name'),

        ];
    }
}
