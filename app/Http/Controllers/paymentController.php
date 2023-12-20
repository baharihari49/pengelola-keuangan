<?php

namespace App\Http\Controllers;

use App\Helper\DatabaseHelper;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use GuzzleHttp;
use PhpParser\Node\Stmt\Return_;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
class paymentController extends Controller
{

    public function index()
    {
        return view('user.payments.index');
    }

    public function store(Request $request)
    {
        $ch = curl_init();
        $secret_key = env('SECRETKEY_FLIP');
        $encoded_auth = base64_encode($secret_key . ":");
        $base_url = env('BASE_URL');

        curl_setopt($ch, CURLOPT_URL, $base_url."pwf/bill");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $payloads = [
            "title" => 'Langganan octans finance',
            "amount" => 10000,
            "type" => "SINGLE",
            "redirect_url" => "", // Ganti dengan URL yang valid
            "is_address_required" => 0,
            "is_phone_number_required" => 0,
            'step' => 3,
            'sender_name' => request()->sender_name,
            'sender_email' => request()->sender_email,
            "sender_bank"=> "qris",
            "sender_bank_type"=> "wallet_account",
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payloads));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic " . $encoded_auth,
            "Content-Type: application/x-www-form-urlencoded"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $dataResponse = json_decode($response);


        $qrCode = $dataResponse->bill_payment->receiver_bank_account->qr_code_data;

        $payment = new Payment();

        $payment->title = $dataResponse->title;
        $payment->amount = $dataResponse->amount;
        $payment->status = 'pending';
        $payment->external_id = $dataResponse->link_id;
        $payment->url = $dataResponse->payment_url;
        $payment->user_id = auth()->user()->id;

        if($payment->save()){
            $paymenId = Payment::where('user_id', auth()->user()->id)->value('id');
            User::where('id', auth()->user()->id)->update(['payment_id' => $paymenId]);
            return view('user.payments.chosePayment.layouts.qris',[
                'qrCode' => $qrCode,
            ]);
        }


    }

    public function createBillVA()
    {
        $ch = curl_init();
        $secret_key = env('SECRETKEY_FLIP');
        $encoded_auth = base64_encode($secret_key . ":");
        $base_url = env('BASE_URL');

        curl_setopt($ch, CURLOPT_URL, $base_url."pwf/bill");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $payloads = [
            "title" => 'Langganan octans finance',
            "amount" => 10000,
            "type" => "SINGLE",
            "redirect_url" => "", // Ganti dengan URL yang valid
            "is_address_required" => 0,
            "is_phone_number_required" => 0,
            'step' => 3,
            'sender_name' => request()->sender_name,
            'sender_email' => request()->sender_email,
            "sender_bank"=> request()->sender_bank,
            "sender_bank_type"=> "virtual_account",
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payloads));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic " . $encoded_auth,
            "Content-Type: application/x-www-form-urlencoded"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $dataResponse = json_decode($response);

        // return $dataResponse;

        $noVa = $dataResponse->bill_payment->receiver_bank_account->account_number;
        $noVa_terpisah = chunk_split($noVa, 4, '-');
        $noVa_terpisah = rtrim($noVa_terpisah, '-');

        $senderBank = $dataResponse->bill_payment->sender_bank;
        // $qrCode = $dataResponse->bill_payment->receiver_bank_account->qr_code_data;

        $payment = new Payment();

        $payment->title = $dataResponse->title;
        $payment->amount = $dataResponse->amount;
        $payment->status = 'pending';
        $payment->external_id = $dataResponse->link_id;
        $payment->url = $dataResponse->payment_url;
        $payment->user_id = auth()->user()->id;

        if($payment->save()){
            $paymenId = Payment::where('user_id', auth()->user()->id)->value('id');
            User::where('id', auth()->user()->id)->update(['payment_id' => $paymenId]);
            return view('user.payments.chosePayment.layouts.virtual_account',[
                'noVa' => $noVa_terpisah,
                'sender_bank' => $senderBank,
                'amount' => $dataResponse->amount
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $response = $request->data;
        $data = json_decode($response);

        $payment = Payment::where('external_id', $data->bill_link_id)->first();

        if ($payment && $payment->status == 'pending') {
            App::setLocale('id');

            $date = Carbon::now();
            $nextMonth = $date->addMonth();

            Payment::where('external_id', $data->bill_link_id)->update([
                'status' => strtolower($data->status),
                'langganan_berakhir' => $nextMonth->toDateString(),
            ]);
        }


    }


    public function testPayment()
    {
        $ch = curl_init();
        $secret_key = env('SECRETKEY_FLIP');
        $encoded_auth = base64_encode($secret_key . ":");
        $base_url = env('BASE_URL');

        curl_setopt($ch, CURLOPT_URL, $base_url ."disbursement/bank-account-inquiry");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $payloads = [
            "account_number" => "1212121214",
            "bank_code" => "bni",
            "amount" => "10000",
            "remark" => "some remark",
            "recipient_city" => "391",
            "beneficiary_email" => "test@mail.com,user@mail.com"
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payloads));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/x-www-form-urlencoded",
          "idempotency-key: idem-key-1",
          "X-TIMESTAMP: 2022-01-01T15:02:15+0700"
        ));

        curl_setopt($ch, CURLOPT_USERPWD, $secret_key.":");

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }

    public function getBalance()
    {
        $ch = curl_init();
        $secret_key = env('SECRETKEY_FLIP');
        $encoded_auth = base64_encode($secret_key . ":");
        $base_url = env('BASE_URL');

        curl_setopt($ch, CURLOPT_URL, $base_url."general/balance");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Basic " . $encoded_auth,
            "Content-Type: application/x-www-form-urlencoded"
        ));

        curl_setopt($ch, CURLOPT_USERPWD, $secret_key.":");

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function createDisbrusment()
    {
        $client = new GuzzleHttp\Client();

        //$base_url = 'https://big.flip.id/api/v2';
        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        $payload = [
            "account_number" => "5465327020",
            "bank_code" => "bca",
            "amount" => "21000000",
            "remark" => "test",
            "recipient_city" => "",
            "beneficiary_email" => "",
        ];

        $payload_acc_inq = [
            "account_number" => "<your_account_inq_number>",
            "bank_code" => "<bank_code_of_your_account>",
        ];

        $signature = DatabaseHelper::getSignature($payload);

        try {
            // Disbursement
            $response = $client->post($base_url. 'disbursement', [
                'form_params' => $payload,
                'auth' => [$secret_key.':',null],
                'headers' => [
                    'X-Signature' => $signature,
                    'idempotency-key' => 'bahari1234532', // Gantilah dengan kunci idempoten yang unik
                ]
            ]);

                return $response->getBody()->getContents();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

    }

    public function getDisbrusementById()
    {

        $client = new GuzzleHttp\Client();

        //$base_url = 'https://big.flip.id/api/v2';
        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        $payload = [
            "id" => "127854"
        ];

        $payload_acc_inq = [
            "account_number" => "<your_account_inq_number>",
            "bank_code" => "<bank_code_of_your_account>",
        ];

        $signature = DatabaseHelper::getSignature($payload);

        try {
            // Disbursement
            $response = $client->get($base_url.'get-disbursement?id=127854', [
                'form_params' => $payload,
                'auth' => [$secret_key.':',null],
                'headers' => [
                    'X-Signature' => $signature,
                    'idempotency-key' => '2334567890', // Gantilah dengan kunci idempoten yang unik
                ]
            ]);

                return $response->getBody()->getContents();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
    }

    public function getDisbrusementByIdempotency()
    {
        $client = new GuzzleHttp\Client();
        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        $payload = [
            "idempotency-key" => "idem-key-3"
        ];

        $payload_acc_inq = [
            "account_number" => "<your_account_inq_number>",
            "bank_code" => "<bank_code_of_your_account>",
        ];


        $signature = DatabaseHelper::getSignature($payload);

        try {
            // Disbursement
            $response = $client->get($base_url.'get-disbursement?idempotency-key=idem-key-3', [
                'form_params' => $payload,
                'auth' => [$secret_key.':',null],
                'headers' => [
                    'X-Signature' => $signature,
                    // 'idempotency-key' => '2334567890', // Gantilah dengan kunci idempoten yang unik
                ]
            ]);

                return $response->getBody()->getContents();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
    }

    public function getAllDisbrusment()
    {
        $client = new GuzzleHttp\Client();

        //$base_url = 'https://big.flip.id/api/v2';
        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        $payload = [
            "pagination" => '10',
            "page" => '10',
            // "sort" => 'sort',
            // "attribute" => 'value'
        ];

        $signature = DatabaseHelper::getSignature($payload);

        try {
            // Disbursement
            $response = $client->get($base_url.'disbursement?pagination=10&page=10', [
                'form_params' => $payload,
                'auth' => [$secret_key.':',null],
                'headers' => [
                    'X-Signature' => $signature,
                    // 'idempotency-key' => '2334567890', // Gantilah dengan kunci idempoten yang unik
                ]
            ]);

                return $response->getBody()->getContents();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
    }

    public function cityList()
    {
        $client = new GuzzleHttp\Client();

        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        $payload = [];

        $signature = DatabaseHelper::getSignature($payload);

        try {
            // Disbursement
            $response = $client->get($base_url.'disbursement/city-list', [
                'form_params' => $payload,
                'auth' => [$secret_key.':',null],
                'headers' => [
                    'X-Signature' => $signature,
                    // 'idempotency-key' => '2334567890', // Gantilah dengan kunci idempoten yang unik
                ]
            ]);

                return $response->getBody()->getContents();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }


    }

    public function countryList()
    {
        $client = new GuzzleHttp\Client();

        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        $payload = [];

        $signature = DatabaseHelper::getSignature($payload);

        try {
            // Disbursement
            $response = $client->get($base_url.'disbursement/country-list', [
                'form_params' => $payload,
                'auth' => [$secret_key.':',null],
                'headers' => [
                    'X-Signature' => $signature,
                    // 'idempotency-key' => '2334567890', // Gantilah dengan kunci idempoten yang unik
                ]
            ]);

                return $response->getBody()->getContents();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
    }


    public function cityAndCountryList()
    {
        $client = new GuzzleHttp\Client();

        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        $payload = [];

        $signature = DatabaseHelper::getSignature($payload);

        try {
            // Disbursement
            $response = $client->get($base_url.'disbursement/city-country-list', [
                'form_params' => $payload,
                'auth' => [$secret_key.':',null],
                'headers' => [
                    'X-Signature' => $signature,
                    // 'idempotency-key' => '2334567890', // Gantilah dengan kunci idempoten yang unik
                ]
            ]);

                return $response->getBody()->getContents();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
    }

    public function bankAccountInquiry()
    {
        $client = new GuzzleHttp\Client();

        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        $payload_acc_inq = [
            "account_number" => "067201000299301",
            "bank_code" => "bri",
            "inquiry_key" => "aVncCDdKW9dciRvH9qSH"
        ];
        $signature_acc_inq= DatabaseHelper::getSignature($payload_acc_inq);

        try {
            //    Account Inquiry
        $response = $client->post($base_url.'disbursement/bank-account-inquiry', [
            'form_params' => $payload_acc_inq,
            'auth' => [$secret_key.':',null],
            'headers' => [
                'X-Signature' => $signature_acc_inq,
            ]
        ]);

                return $response->getBody()->getContents();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
    }

    public function chosePaymentMethode()
    {
        return view('user.payments.chosePayment.index');
    }

    public function paymentManage()
    {
        $payment = Payment::with('user');

        if(request()->has('status')){
            $payment->where('status', request()->status)->paginate(15);
        }else{
            $payment->paginate(15);
        }

        // return $payment->paginate(15);

        return view('user.payments.paymentManage.index', [
            'data' => $payment->paginate(15)
        ]);
    }

    public function paymentByExternalId()
    {
        $payment = Payment::with('user')->where('external_id', request()->search)->get();
        return view('user.payments.paymentManage.index', [
            'data' => $payment
        ]);
    }

    public function getInfoBank()
    {
        $ch = curl_init();
        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');
        $encoded_auth = base64_encode($secret_key . ":");

        curl_setopt($ch, CURLOPT_URL, $base_url."general/banks");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Basic " . $encoded_auth,
        "Content-Type: application/x-www-form-urlencoded"
        ));

        curl_setopt($ch, CURLOPT_USERPWD, $secret_key.":");

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function checkPaymentStatus()
    {
        $payment = Payment::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();

        return $payment->status ?? 'free';

    }
}
