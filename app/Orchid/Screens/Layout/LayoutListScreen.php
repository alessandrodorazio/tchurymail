<?php

namespace App\Orchid\Screens\Layout;

use App\Models\Layout;
use App\Orchid\Layouts\Layout\LayoutListLayout;
use Orchid\Screen\Screen;

class LayoutListScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'LayoutListLayout';
    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'LayoutListLayout';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array {
        return [
            'layouts' => Layout::paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array {
        return [
            LayoutListLayout::class,
        ];
    }
}
