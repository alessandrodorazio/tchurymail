<?php

namespace App\Orchid\Screens\Storage;

use App\Models\Attachment;
use App\Orchid\Layouts\Storage\StorageCreateLayout;
use App\Orchid\Layouts\Storage\StorageListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class StorageListScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'StorageListScreen';
    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'StorageListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array {
        return [
            'attachments' => Attachment::paginate(),
        ];
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
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array {
        return [
            Layout::accordion([
                                  'New attachment' => [
                                      StorageCreateLayout::class,
                                  ],
                              ]),

            StorageListLayout::class,
        ];
    }

    public function upload() {
        Alert::info('Attachment uploaded');

        return redirect()->route('platform.storage.list');
    }

    public function deleteAttachment($id) {
        $attachment = Attachment::find($id);
        $attachment->delete();
        Alert::info('Attachment deleted');

        return redirect()->route('platform.storage.list');
    }
}
