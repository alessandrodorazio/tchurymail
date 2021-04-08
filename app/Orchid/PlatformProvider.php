<?php

namespace App\Orchid;

use App\Models\Email;
use App\Models\Layout;
use App\Models\Template;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider {
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void {
        parent::boot($dashboard);
        // ...
    }

    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array {
        return [
            ItemMenu::label('Templates')
                    ->icon('monitor')
                    ->title('Templates')
                    ->route('platform.templates.list')
                    ->badge(function() {
                        return Template::count();
                    }, Color::PRIMARY()),
            ItemMenu::label('Template categories')->icon('directions')->route('platform.templates.categories.list'),
            ItemMenu::label('Layouts')
                    ->icon('folder')
                    ->title('Layouts')
                    ->route('platform.layouts.list')
                    ->badge(function() {
                        return Layout::count();
                    }, Color::PRIMARY()),

            ItemMenu::label('Emails history')
                    ->icon('envelope')
                    ->route('platform.emails.list')
                    ->title('Emails')
                    ->badge(function() {
                        return Email::count();
                    }, Color::SUCCESS()),
            ItemMenu::label('Images')->icon('camera')->title('Storage')->route('platform.storage.list'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array {
        return [ItemMenu::label('Profile')->route('platform.profile')->icon('user'),];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array {
        return [
            ItemMenu::label(__('Access rights'))
                    ->icon('lock')
                    ->slug('Auth')
                    ->active('platform.systems.*')
                    ->permission('platform.systems.index')
                    ->sort(1000),

            ItemMenu::label(__('Users'))
                    ->place('Auth')
                    ->icon('user')
                    ->route('platform.systems.users')
                    ->permission('platform.systems.users')
                    ->sort(1000)
                    ->title(__('All registered users')),

            ItemMenu::label(__('Roles'))
                    ->place('Auth')
                    ->icon('lock')
                    ->route('platform.systems.roles')
                    ->permission('platform.systems.roles')
                    ->sort(1000)
                    ->title(__('A Role defines a set of tasks a user assigned the role is allowed to perform.')),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array {
        return [
            ItemPermission::group(__('Systems'))
                          ->addPermission('platform.systems.roles', __('Roles'))
                          ->addPermission('platform.systems.users', __('Users')),
            ItemPermission::group('Templates')
                          ->addPermission('platform.templates.view', 'View template')
                          ->addPermission('platform.templates.manage', 'Manage template'),

        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array {
        return [// ...Models
                // \App\Models\User::class
        ];
    }
}
