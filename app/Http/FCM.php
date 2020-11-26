<?php

namespace App\Http;

use App\Models\Sessions;
use App\Models\Customers;
use App\Models\Notification;
use Exception;
use Illuminate\Support\Facades\Log;

if (!defined("SESSIONID")) define("SESSIONID", uniqid());

class FCM
{
    public static function sendFcm($token)
    {
        $fcmUrl     = 'https://fcm.googleapis.com/fcm/send';
        $server_key = env('FCM_SERVERKEY');

        $headers = array('Authorization:key=' . $server_key, 'Content-Type:application/json');

        $fields = array(
            'to'    => $token,
            'data'  => array(
                'title'                 => "Verifikasi",
                'message'               => "Absen anda sudah di verifikasi, dan anda berhasil absen, Selamat Berkerja !!!",

            )
        );

        $payload = json_encode($fields);
        $res = self::doCurl($fcmUrl, $payload, $headers);

        // $notif = new Notification();
        // $notif->customer_id         = $customer->id;
        // $notif->title               = $title;
        // $notif->message             = $message;
        // $notif->type                = $type;
        // $notif->transaction_id      = $id;
        // $notif->amount              = $amount;
        // $notif->transaction_status  = $transaction_status;
        // $notif->status              = "" . ($res["success"] ?? "0");
        // $notif->product_type        = $product_type;
        // $notif->save();

        // return $notif;
        return true;
    }

    public static function doCurl($url, $POSTDATA, $header = array(), $method = "POST")
    {
        try {
            $ch  = curl_init();

            $data = $POSTDATA;
            if (is_array($POSTDATA)) {
                $data = http_build_query($POSTDATA);
            }
            Log::info(SESSIONID . "\REQUEST \tHeader:: " . json_encode($header) . "\t Method:: " . $method . "\t\t" . $data . "\t\tURL::" . $url);

            if ($method == 'GET') $url .= "?" . $data;

            curl_setopt($ch, CURLOPT_URL,                 $url);
            curl_setopt($ch, CURLOPT_HEADER,             TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER,         $header);
            curl_setopt($ch, CURLINFO_HEADER_OUT,        true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,     TRUE);
            if ($method == "POST") {
                curl_setopt($ch, CURLOPT_POST,                 TRUE);
            }
            if (!in_array($method, ['GET', 'POST'])) {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            }
            if ($method != 'GET') {
                curl_setopt($ch, CURLOPT_POSTFIELDS,         $data);
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,     2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,     false);
            curl_setopt($ch, CURLOPT_USERAGENT,         "CUrl/1.0");
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,     30);
            curl_setopt($ch, CURLOPT_TIMEOUT,             30);
            curl_setopt($ch, CURLOPT_VERBOSE,             true);

            $rawResponse     = curl_exec($ch);
            $header_size     = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $httpcode         = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $header         = substr($rawResponse, 0, $header_size);
            $heads             = explode("\n", $header);
            $head              = FALSE;
            foreach ($heads as $v) {
                $v = trim($v);
                if (strlen($v) < 1) continue;
                if (preg_match('/^(HTTP\/\d\.\d) (\d{3}) (.*)/i', $v, $m)) {
                    $head['http'] = $m[1];
                    $head['status_code'] = $m[2];
                    $head['status_string'] = $m[2] . " - " . $m[3];
                } elseif (preg_match('/^([\w\-\.]+):\s*?(\S.*)$/', $v, $m)) {
                    $head[$m[1]] = $m[2];
                } else continue;
            }
            $response['cURLerror'] = curl_error($ch);
            curl_close($ch);
            $response['header'] = $head;

            $body = substr($rawResponse, $header_size);
            $body = trim($body);
            if (!!($jsonRes = json_decode($body, true)))
                $response['body'] = json_decode($body, true);
            else
                $response['body'] = $body;
        } catch (Exception $e) {
            $response['error'] = $e;
        }
        Log::info(SESSIONID . "\tRESPONSE\t\t\t" . json_encode($response));
        return $response['body'];
    }
}
