<?php

namespace App\Orchid\Layouts\Storage;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class StorageCreateLayout extends Rows {
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
            Upload::make('image')->title('New attachment'),
            Button::make('Upload')
                  ->type(Color::DEFAULT())
                  ->icon('check')
                  ->method('upload')->right(),
        ];
    }
}
