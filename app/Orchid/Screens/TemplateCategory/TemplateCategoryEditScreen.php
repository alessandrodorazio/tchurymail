<?php

namespace App\Orchid\Screens\TemplateCategory;

use App\Models\TemplateCategory;
use App\Orchid\Layouts\TemplateCategory\TemplateCategoryEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class TemplateCategoryEditScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create template category';
    /**
     * Display header description.
     *
     * @var string|null
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(TemplateCategory $tc): array {
        $this->exists = $tc->exists;

        if( $this->exists ) {
            $this->name = 'Edit template category';
        }

        return ['tc' => $tc];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array {
        return [
            Button::make('Save')->icon('save')->method('createOrUpdate'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array {
        return [
            TemplateCategoryEditLayout::class,
        ];
    }

    public function createOrUpdate(TemplateCategory $tc, Request $request) {
        $tc->fill($request->get('tc'))->save();
        Alert::info('You have successfully created/updated a category.');

        return redirect()->route('platform.templates.categories.list');
    }
}
