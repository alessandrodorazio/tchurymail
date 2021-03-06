<?php

namespace App\Orchid\Screens\Template;

use App\Models\Template;
use App\Orchid\Layouts\Template\EditCodeLayout;
use App\Orchid\Layouts\Template\TemplateEditLayout;
use App\Orchid\Layouts\Template\TemplateSecretLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class TemplateEditScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create Template';
    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Create a template for your business';
    public $exists = false;
    public $permission = ['platform.templates.manage'];

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Template $template): array {
        $this->exists = $template->exists;

        if( $this->exists ) {
            $this->name = 'Edit template';
            $this->description = 'Customize the template';
        }
        $this->template = $template;
        $template->attachments = $this->template->attachments()->get();

        return ['template' => $template];
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

            Link::make('Preview')
                ->icon('browser')
                ->href(route('mail_preview', $this->template->secret_api ?: ''))
                ->target('_blank')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array {
        return [
            TemplateEditLayout::class,
            EditCodeLayout::class,
            //TemplateAttachmentsLayout::class,
            TemplateSecretLayout::class,

        ];
    }

    public function createOrUpdate(Template $template, Request $request) {
        $template->fill($request->get('template'))->save();

        $templateTemp = $request->get('template');

        if( is_null($templateTemp["secret_api"]) ) {
            $template->secret_api = Str::uuid();
            $template->save();
        }

        if( $request->input('template.attachments') !== null ) {
            foreach( $request->input('template.attachments') as $attachmentId ) {
                $attachment = Attachment::find($attachmentId);
                $attachment->template_id = $template->id;
                $attachment->save();
            }
        }

        $alertMessage =
            $template->exists ? 'You have successfully updated the template' :
                'You have successfully created the template.';
        Alert::info($alertMessage);

        return redirect()->route('platform.templates.edit', ['template' => $template->id]);
    }

    public function remove(Template $template) {
        $template->delete();

        Alert::info('You have successfully deleted the template.');

        return redirect()->route('platform.templates.list');
    }

    public function preview(Template $template) {
        return redirect()->route('mail_preview', ['uuid' => $template->secret_api]);
    }

    public function uploadAttachments(Template $template, Request $request) {
        if( $request->input('template.attachments') !== null ) {
            foreach( $request->input('template.attachments') as $attachmentId ) {
                $attachment = Attachment::find($attachmentId);
                $attachment->template_id = $template->id;
                $attachment->save();
            }
        }

        return redirect()->refresh();
    }

    public function duplicate(Template $template) {
        $replicate = $template->replicate();
        $replicate->name = $replicate->name . ' copy';
        $replicate->secret_api = Str::uuid();
        $replicate->save();

        return redirect()->route('platform.templates.list');
    }
}
