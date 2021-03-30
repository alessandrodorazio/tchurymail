<?php

namespace App\Orchid\Screens\Template;

use App\Models\Template;
use App\Models\TemplateType;
use App\Orchid\Layouts\Template\EditCodeLayout;
use App\Orchid\Layouts\Template\TemplateEditLayout;
use App\Orchid\Layouts\Template\TemplateSecretLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use PHPUnit\Util\Color;

class TemplateEditScreen extends Screen
{
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
    public function query(Template $template): array
    {
        $this->exists = $template->exists;

        if ($this->exists) {
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
    public function commandBar(): array
    {
        return [Button::make('Create post')->icon('pencil')->method('createOrUpdate')->canSee(!$this->exists),

            Button::make('Update')->icon('note')->method('createOrUpdate')->canSee($this->exists),

            Button::make('Remove')->icon('trash')->method('remove')->canSee($this->exists),

            Link::make('Preview')->icon('browser')->href(route('mail_preview', $this->template->secret_api?:''))->target('_blank')->canSee($this->exists),];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::block(TemplateEditLayout::class)
                ->title('Template settings')
                ->description('Basic informations about the template')
                ->commands(
                    Button::make('Save')->type(\Orchid\Support\Color::DEFAULT())->method('createOrUpdate')
                ),
            Layout::block(EditCodeLayout::class)->title('Edit code')->description('Write your MJML code easily')->commands(
                Button::make('Save')->type(\Orchid\Support\Color::DEFAULT())->method('createOrUpdate')
            ),
            Layout::block(TemplateSecretLayout::class)->title('Secrets')->description('The unique ID of this template')
        ];
        return [Layout::rows([Input::make('template.name')
            ->title('Title')
            ->placeholder('Attractive but mysterious title'),

            Code::make('template.content')->title('Content of the email')->lineNumbers(),

            Relation::make('template.type_id')->title('Type')->fromModel(TemplateType::class, 'name')->canSee(!$this->exists),

            Relation::make('template.header_id')
                ->canSee(!$this->exists || $this->template->type->name === "Content")
                ->title('Header')
                ->applyScope('headerList')
                ->fromModel(Template::class, 'name'),

            Relation::make('template.footer_id')
                ->canSee(!$this->exists || $this->template->type->name === "Content")
                ->title('Footer')
                ->applyScope('footerList')
                ->fromModel(Template::class, 'name'),

            Input::make('template.secret_api')
                ->canSee($this->exists && $this->template->type->name === "Content")
                ->disabled()
                ->title('Secret Key')
                ->help('Don\'t share this secret with anyone (except your devs)'),

        ]),
        ];
    }

    public function createOrUpdate(Template $template, Request $request)
    {
        $template->fill($request->get('template'))->save();
        Alert::info('You have successfully created/updated a post.');
        return redirect()->route('platform.templates.list', ['type' => $template->type->name]);
    }


    public function remove(Template $template)
    {
        $template->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.templates.list');
    }

    public function preview(Template $template)
    {
        return redirect()->route('mail_preview', ['uuid' => $template->secret_api]);
    }
}
