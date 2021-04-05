<?php

namespace App\Orchid\Screens\Email;

use App\Models\Email;
use App\Orchid\Layouts\Email\EmailListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class EmailHistoryListScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'EmailHistoryListScreen';
    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'EmailHistoryListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array {
        return ['emails' => Email::filters()->defaultSort('created_at', 'desc')->with('template')->paginate()];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array {
        return [];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array {
        return [EmailListLayout::class];
    }
}
