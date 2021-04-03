<?php

namespace App\Orchid\Layouts\Template;

use App\Models\Template;
use App\Models\TemplateCategory;
use App\Models\TemplateType;
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
        $exists = !is_null($template->id);

        return [
            Input::make('template.name')->title('Name')->placeholder('What is the name of this email?')->required(),

            Input::make('template.subject')
                 ->title('Subject')
                 ->placeholder('The subject of the email')->required()
                 ->canSee(!$exists || $template->type->name === "Content")
            ,

            Relation::make('template.type_id')
                    ->title('Type')
                    ->fromModel(TemplateType::class, 'name')->required()
                    ->canSee(!$exists),

            Relation::make('template.category_id')
                    ->title('Category')
                    ->fromModel(TemplateCategory::class, 'name'),

            Relation::make('template.header_id')
                    ->canSee(!$exists || $template->type->name === "Content")
                    ->title('Header**')
                    ->help('Only if is a content')
                    ->applyScope('headerList')
                    ->fromModel(Template::class, 'name'),

            Relation::make('template.footer_id')
                    ->canSee(!$exists || $template->type->name === "Content")
                    ->title('Footer**')
                    ->help('Only if is a content')
                    ->applyScope('footerList')
                    ->fromModel(Template::class, 'name'),
        ];
    }
}
