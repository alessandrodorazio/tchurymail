<?php

namespace App\Orchid\Layouts\Template;

use App\Models\Template;
use App\Models\TemplateType;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class TemplateEditLayout extends Rows
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
        $template = $this->query->get('template');
        $exists = !is_null($template->id);
        return [
            Input::make('template.name')
                ->title('Title')
                ->placeholder('Attractive but mysterious title'),
            Relation::make('template.type_id')->title('Type')->fromModel(TemplateType::class, 'name')->canSee(!$exists),

            Relation::make('template.header_id')
                ->canSee(!$exists || $template->type->name === "Content")
                ->title('Header')
                ->applyScope('headerList')
                ->fromModel(Template::class, 'name'),

            Relation::make('template.footer_id')
                ->canSee(!$exists || $template->type->name === "Content")
                ->title('Footer')
                ->applyScope('footerList')
                ->fromModel(Template::class, 'name'),
        ];
    }
}
