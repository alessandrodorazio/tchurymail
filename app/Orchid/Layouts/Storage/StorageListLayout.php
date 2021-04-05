<?php

namespace App\Orchid\Layouts\Storage;

use App\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StorageListLayout extends Table {
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'attachments';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array {
        return [
            TD::make('preview')->render(function($att) {
                return '<img src="' . $att->url() . '" style="max-width:80px" />';
            }),
            TD::make('original_name', 'File name'),
            TD::make('URL')->render(function($att) {
                return $att->url();
            })->defaultHidden(),
            TD::make(__('Actions'))->align(TD::ALIGN_RIGHT)->render(function(Attachment $att) {
                return DropDown::make()->icon('options-vertical')->list([
                                                                            Button::make('Delete')
                                                                                  ->icon('trash')
                                                                                  ->method('deleteAttachment')
                                                                                  ->parameters(['id' => $att->id]),
                                                                        ]);
            }),
        ];
    }
}
