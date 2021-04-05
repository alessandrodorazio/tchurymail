<?php

namespace App\Orchid\Layouts\Email;

use App\Models\Email;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EmailListLayout extends Table {
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'emails';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array {
        return [
            TD::make('id', 'ID'),
            TD::make('recipient', 'Recipient')->sort(),
            TD::make('template.name', 'Email'),
            TD::make('created_at', 'Sent At')->sort()
              ->render(function(Email $email) {
                  return $email->created_at->toDateTimeString();
              }),
        ];
    }
}
