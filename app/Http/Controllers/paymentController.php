<?php

namespace App\Http\Controllers;

use App\Helper\DatabaseHelper;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class paymentController extends Controller
{

    public function index()
    {
        return view('user.payments.index');
    }

    public function store(Request $request)
    {
        $ch = curl_init();
        $secret_key = "JDJ5JDEzJE03cTlhVGJrS0NVTkRVTnlJWjlLYWVPOFl3cXVpOGxvL0VIUkJrekFqZlU2ZUhnd3NpTTZD";
        $encoded_auth = base64_encode($secret_key . ":");

        curl_setopt($ch, CURLOPT_URL, "https://bigflip.id/big_sandbox_api/v2/pwf/bill");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $payloads = [
            "title" => request()->title,
            "amount" => request()->amount,
            "type" => "SINGLE",
            "expired_date" => "2023-12-30 15:50",
            "redirect_url" => "https://uat.octansidn.com/", // Ganti dengan URL yang valid
            "is_address_required" => 0,
            "is_phone_number_required" => 0
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payloads));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic " . $encoded_auth,
            "Content-Type: application/x-www-form-urlencoded"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $dataResponse = json_decode($response);


        $payment = new Payment();

        $payment->title = $request->title;
        $payment->amount = $request->amount;
        $payment->status = 'pending';
        $payment->external_id = $dataResponse->link_id;
        $payment->url = $dataResponse->link_url;
        $payment->user_id = auth()->user()->id;

        if($payment->save()){
            $paymenId = Payment::where('user_id', auth()->user()->id)->value('id');
            User::where('id', auth()->user()->id)->update(['payment_id' => $paymenId]);
            return redirect('https://'.$dataResponse->link_url);
        }


    }

    public function changeStatus(Request $request)
    {
        $response = $request->data;
        $data = json_decode($response);

        $payment = Payment::where('external_id', $data->bill_link_id)->value('status');

        if ($payment == 'pending') {
            Payment::where('external_id', $data->bill_link_id)->update([
                'status' => strtolower($data->status),
                'langganan_berakhir' => DatabaseHelper::getNextMonth()
            ]);
        }

    }
}
