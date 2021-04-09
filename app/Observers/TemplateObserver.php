<?php

namespace App\Observers;

use App\Models\Template;
use Illuminate\Support\Str;

class TemplateObserver {
    /**
     * Handle the Template "created" event.
     *
     * @param Template $template
     * @return void
     */
    public function created(Template $template) {
        //
        $template->secret_api = Str::uuid();
        $template->save();
    }

    /**
     * Handle the Template "updated" event.
     *
     * @param Template $template
     * @return void
     */
    public function updated(Template $template) {
        //
    }

    /**
     * Handle the Template "deleted" event.
     *
     * @param Template $template
     * @return void
     */
    public function deleted(Template $template) {
        //
    }

    /**
     * Handle the Template "restored" event.
     *
     * @param Template $template
     * @return void
     */
    public function restored(Template $template) {
        //
    }

    /**
     * Handle the Template "force deleted" event.
     *
     * @param Template $template
     * @return void
     */
    public function forceDeleted(Template $template) {
        //
    }
}
