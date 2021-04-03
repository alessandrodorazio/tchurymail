<?php

namespace App\Orchid\Screens\Template;

use App\Models\Template;
use App\Orchid\Layouts\Template\EditCodeLayout;
use App\Orchid\Layouts\Template\EditHeadLayout;
use App\Orchid\Layouts\Template\TemplateAttachmentsLayout;
use App\Orchid\Layouts\Template\TemplateEditLayout;
use App\Orchid\Layouts\Template\TemplateSecretLayout;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

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
    public $description = 'Create a brand-new template for your business';
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

        return ['template' => $template];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array {
        return [
            Button::make('Create template')->icon('pencil')->method('createOrUpdate')->canSee(!$this->exists),

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
            Layout::block(TemplateEditLayout::class)
                  ->title('Template settings')
                  ->description('Basic informations about the template')
                  ->commands(Button::make('Save')
                                   ->type(Color::DEFAULT())
                                   ->method('createOrUpdate')),
            Layout::block(EditCodeLayout::class)
                  ->title('Edit code')
                  ->description('Write your MJML code easily. <br> Tested tags: <br> - mj-button <br> - mj-carousel <br> -  mj-column <br> -  mj-divider <br> -  mj-hero <br> -  mj-image <br> - mj-section <br> - mj-social <br> -  mj-spacer <br> -  mj-table <br> -  mj-text <br> -  mj-wrapper')
                  ->commands(Button::make('Save')
                                   ->type(Color::DEFAULT())
                                   ->method('createOrUpdate')),
            Layout::block(EditHeadLayout::class)
                  ->title('Edit head')
                  ->description('Add your head tags here. <br> Tested tags: <br> - mj-attributes <br> - mj-font <br> - mj-preview <br> - mj-style <br> - mj-title')
                  ->commands(Button::make('Save')
                                   ->type(Color::DEFAULT())
                                   ->method('createOrUpdate')),
            Layout::block(TemplateAttachmentsLayout::class)->title('Attachments')->commands(Button::make('Save')
                                                                                                  ->type(Color::DEFAULT())
                                                                                                  ->method('uploadAttachments')),
            Layout::block(TemplateSecretLayout::class)
                  ->title('Secrets')
                  ->description('The unique ID of this template'),
        ];
    }

    public function createOrUpdate(Template $template, Request $request) {
        $template->fill($request->get('template'))->save();

        if( $request->input('template.attachments') !== null ) {
            foreach( $request->input('template.attachments') as $attachmentId ) {
                $attachment = Attachment::find($attachmentId);
                $attachment->template_id = $template->id;
                $attachment->save();
            }
        }
        Alert::info('You have successfully created/updated a template.');

        return redirect()->route('platform.templates.list', ['type' => $template->type->name]);
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
        $replicate->secret_api = \Illuminate\Support\Str::uuid();
        $replicate->save();

        return redirect()->route('platform.templates.list');
    }
}
