<?php

namespace App\Orchid\Screens\Template;

use App\Models\Template;
use App\Models\TemplateCategory;
use App\Orchid\Layouts\Template\TemplateListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class TemplateListScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Template list';
    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = '';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array {
        $templates = Template::filters()->defaultSort('name')->with('category');
        if( isset($_GET['category']) ) {
            $category = TemplateCategory::where('name', $_GET['category'])->first();
            $templates = $templates->where('category_id', $category->id);
        }
        $templates = $templates->paginate();

        return ['templates' => $templates];
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
                ->route('platform.templates.edit'),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array {
        return [TemplateListLayout::class];
    }
}
