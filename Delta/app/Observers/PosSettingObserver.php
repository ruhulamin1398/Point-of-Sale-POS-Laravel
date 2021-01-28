<?php

namespace App\Observers;

use App\Models\brand;
use App\Models\posSetting;
use Illuminate\Support\Facades\App;

class PosSettingObserver
{
    /**
     * Handle the posSetting "created" event.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return void
     */
    public function created(posSetting $posSetting)
    {
        //
    }

    /**
     * Handle the posSetting "updated" event.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return void
     */
    public function updated(posSetting $posSetting)
    {
        //   $brand = new brand;
        //  $brand->name = 'test bradngfggrr';
        //  $brand->save();

    }

    /**
     * Handle the posSetting "deleted" event.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return void
     */
    public function deleted(posSetting $posSetting)
    {
        //
    }

    /**
     * Handle the posSetting "restored" event.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return void
     */
    public function restored(posSetting $posSetting)
    {
        //
    }

    /**
     * Handle the posSetting "force deleted" event.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return void
     */
    public function forceDeleted(posSetting $posSetting)
    {
        //
    }
}
