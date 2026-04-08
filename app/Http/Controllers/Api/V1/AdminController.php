<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

use Mail;

use App\Mail\MassEmail;

class AdminController extends BaseController
{

   /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mail(Request $request)
    {
        $data = [
            'recipients' => $request->recipients,
            'subject' => $request->subject,
            'content' => $request->content
        ];

        $emails = explode(';', $data['recipients']);

        foreach ($emails as $email) {
            $email = str_replace(' ', '', $email);
            if (!empty($email)) {
                Mail::to($email)->bcc(env('MAIL_FROM_ADDRESS_BCC'))->send(new \App\Mail\MassEmail($data));
            }
        }

        return response()->json($data, Response::HTTP_CREATED);
    }
}
