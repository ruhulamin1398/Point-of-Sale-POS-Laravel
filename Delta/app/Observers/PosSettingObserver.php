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
            session(['shop_name' => $posSetting->shop_name]);
            session(['shop_moto' => $posSetting->shop_moto]);
            session(['shop_phone' => $posSetting->shop_phone]);
            session(['shop_email' => $posSetting->shop_email]);
            session(['language' => $posSetting->language]);
            session(['logo' => $posSetting->logo]);

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
