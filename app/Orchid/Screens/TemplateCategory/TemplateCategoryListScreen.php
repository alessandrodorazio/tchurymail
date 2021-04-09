<?php

namespace App\Orchid\Screens\TemplateCategory;

use App\Models\TemplateCategory;
use App\Orchid\Layouts\TemplateCategory\TemplateCategoryListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class TemplateCategoryListScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Template categories';
    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Group your templates with categories';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array {
        return [
            'categories' => TemplateCategory::paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array {
        return [
            Link::make('New')
                ->icon('plus')
                ->canSee(Auth::user()->hasAccess('platform.templates.manage'))
                ->route('platform.templates.categories.edit'),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array {
        return [
            TemplateCategoryListLayout::class,
        ];
    }
}
