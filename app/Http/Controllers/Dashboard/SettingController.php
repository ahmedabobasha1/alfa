<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\SettingsRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function show()
    {
        // Ensure the user has permission to edit settings
        $this->authorize('settings.edit');

        // Fetch settings where language is 'all'
        $settings = Setting::where('lang', 'all')->pluck('value', 'key');

        // Define known international dialing codes
        $countryCodes = ['+20', '+966', '+971', '+1'];

        // Start with defaults
        $whatsapp = $settings['site_whatsapp'] ?? '';
        $phone = $settings['phone'] ?? '';
        $whatsappCode = '';
        $phoneCode = '';

        // Detect country code in WhatsApp number
        foreach ($countryCodes as $code) {
            if (str_starts_with($whatsapp, $code)) {
                $whatsappCode = $code;
                $whatsapp = substr($whatsapp, strlen($code));
                break;
            }
        }

        // Detect country code in phone number
        foreach ($countryCodes as $code) {
            if (str_starts_with($phone, $code)) {
                $phoneCode = $code;
                $phone = substr($phone, strlen($code));
                break;
            }
        }

        // Use WhatsApp's code as the main country_code, or phone's if not found
        $settings['country_code'] = $whatsappCode ?: $phoneCode;
        $settings['site_whatsapp'] = $whatsapp;
        $settings['phone'] = $phone;


        return view('Dashboard.Settings.edit', compact('settings'));
    }

    public function update(SettingsRequest $request)
    {
        $this->authorize('settings.update');
        try {
            // Begin a transaction
            DB::beginTransaction();

            $data = $request->validated();

            $data['site_whatsapp'] = $data['country_code'].$data['site_whatsapp'];
            $data['phone'] = $data['country_code'].$data['phone'];

           

            // Optional: remove the country code key if you don't want to store it separately
            unset($data['country_code']);

            foreach ($data as $key => $value) {
                Setting::updateOrCreate(
                    ['key' => $key, 'lang' => 'all'],
                    ['value' => $value]
                );
            }

            // Clear settings cache for this language
            Cache::forget('settings');

            DB::commit();

            return redirect()->back()->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {
         
            DB::rollback();

            return redirect()->back()->with(['error' => __('dashboard.something_went_wrong')]);
        }

    }

}
