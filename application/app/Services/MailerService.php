<?php
namespace App\Service;

use Illuminate\Support\Facades\Mail;
use App\Models\Config;

class MailerService {
    public static function contact($contact){
        $config = Config::find(1);
        try {
            Mail::send('frontend.email.contact', $contact,
                function ($message) use ($contact,$config) {
                    $message
                        ->to($contact->email,$config->email)
                        ->subject('['.$config->title.'] Pertanyaan / Saran');
                });
            $result['status'] = true;
        }catch(\Exception $msg){
            \Log::error($msg);
            $result['status'] = false;
            $result['message'] = $msg;
        }

        return $result;
    }

    /*public static function orderSuccess($order, $emailTo){
        $config = Config::find(1);
        try {
            Mail::send('frontend.email.orderSuccess', $order,
                function ($message) use ($emailTo,$config) {
                    $message
                        ->to($emailTo)
                        ->subject('['.$config->title.'] Berhasil Order');
                });

            Mail::send('frontend.email.orderSuccess', $order,
                function ($message) use ($emailTo,$config) {
                    $message
                        ->to($config->email)
                        ->subject('['.$config->title.'] New Order');
                });

            $result['status'] = true;
        }catch(\Exception $msg){
            \Log::error($msg);
            $result['status'] = false;
            $result['message'] = $msg;
        }

        return $result;
    }*/
}
