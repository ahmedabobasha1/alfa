<?php

namespace App\Services\Website;

use App\Mail\ContactUsMail;
use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactUsService
{
    public function store($data)
    {
        DB::beginTransaction();

        try {
            // Create the ContactUs
            $contactUs = ContactUs::create($data);
            $ccEmails = explode(',', config('settings.cc_emails'));
            // send email to admin
            Mail::to(config('settings.mail_from_address'))
                ->cc($ccEmails)
                ->send(new ContactUsMail($contactUs));

            DB::commit();

            return true;
        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;
        }
    }
}
