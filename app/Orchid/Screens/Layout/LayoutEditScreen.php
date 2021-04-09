<?php

namespace App\Orchid\Screens\Layout;

use App\Models\Layout;
use App\Orchid\Layouts\Layout\LayoutEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class LayoutEditScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create Layout';
    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Create a brand-new layout for your templates';
    public $exists = false;
    public $permission = ['platform.templates.manage'];

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Layout $layout): array {
        $this->exists = $layout->exists;

        if( $this->exists ) {
            $this->name = 'Edit layout';
            $this->description = 'Customize the layout';
        }
        $this->layout = $layout;

        return ['layout' => $layout];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array {
        return [
            Button::make('Save')->icon('pencil')->method('createOrUpdate')->canSee(!$this->exists),

            Button::make('Update')->icon('note')->method('createOrUpdate')->canSee($this->exists),
            Button::make('Copy')->icon('paste')->method('duplicate')->canSee($this->exists),

            Button::make('Remove')->icon('trash')->method('remove')->canSee($this->exists),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array {
        return [
            LayoutEditLayout::class,
        ];
    }

    public function createOrUpdate(Layout $layout, Request $request) {
        $layout->fill($request->get('layout'))->save();

        $alertMessage =
            $layout->exists ? 'You have successfully updated the layout' : 'You have successfully created the layout.';
        Alert::info($alertMessage);

        return redirect()->route('platform.layouts.edit', ['layout' => $layout->id]);
    }

    public function remove(Layout $layout) {
        $layout->delete();

        Alert::info('You have successfully deleted the layout.');

        return redirect()->route('platform.layouts.list');
    }

    public function duplicate(Layout $layout) {
        $replicate = $layout->replicate();
        $replicate->name = $replicate->name . ' copy';
        $replicate->save();

        return redirect()->route('platform.layouts.list');
    }
}
