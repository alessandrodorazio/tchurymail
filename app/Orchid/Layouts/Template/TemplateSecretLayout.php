<?php

namespace App\Orchid\Layouts\Template;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class TemplateSecretLayout extends Rows {
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
            Input::make('template.secret_api')
                 ->readonly()
                 ->title('🔐 Secret API Key')
                 ->help('<strong>Don\'t share this secret with anyone (except your devs)</strong>'),
        ];
    }
}
