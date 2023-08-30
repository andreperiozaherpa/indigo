<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Splpjabar
{

    protected $baseURL;
    protected $tokenURL;
    protected $clientId;
    protected $clientSecret;

    protected $accessToken;

    public function __construct($config = '')
    {
        $this->baseURL = 'http://125.213.129.172:8290';
        $this->tokenURL = 'https://125.213.129.172:9453/oauth2/token';
        if ($config != '') {
            if (isset($config['clientId'])) {
                $this->clientId = $config['clientId'];
            }
            if (isset($config['clientSecret'])) {
                $this->clientSecret = $config['clientSecret'];
            }

        }
        $this->CI =& get_instance();
    }

    private function getToken()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->tokenURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=$this->clientId&client_secret=$this->clientSecret&audience=YOUR_API_IDENTIFIER",
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return false;
        } else {
            $response = json_decode($response);
            $this->accessToken = $response->access_token;
            return $response->access_token;
        }
    }

    private function curl($eo_path, $path, $method = 'GET', $data = [], $param = [])
    {

        if ($this->accessToken == null) {
            $accessToken = $this->getToken();
        } else {
            $accessToken = $this->accessToken;
        }

        if (!empty($param)) {
            $param = '?' . http_build_query($param);
        } else {
            $param = '';
        }
        $urlCurl = $this->baseURL . '/' . $eo_path . '/1/ekosistem/' . $path . $param;


        $curl = curl_init();
        $curl_arr = array(
            CURLOPT_URL => $urlCurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $accessToken,
            ),
        );

        if ($method == 'POST') {
            $curl_arr[CURLOPT_POSTFIELDS] = $data;
        }

        curl_setopt_array(
            $curl,
            $curl_arr
        );
        //with error handlle
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return false;
        } else {
            return $response;
        }

    }

    public function setAccessToken($token)
    {
        $this->accessToken = $token;
    }

    public function getTujuan($eo_path = '', $param = [])
    {
        $response = $this->curl($eo_path, 'tujuan', 'GET', [], $param);
        return json_decode($response);
    }

    public function getKlasifikasi($eo_path = '', $param = [])
    {
        $response = $this->curl($eo_path, 'klasifikasi-arsip', 'GET', [], $param);
        return json_decode($response);
    }

    public function getJenisNaskah($eo_path = '', $param = [])
    {
        $response = $this->curl($eo_path, 'jenis-naskah', 'GET', [], $param);
        return json_decode($response);
    }

    public function getSifatNaskah($eo_path = '', $param = [])
    {
        $response = $this->curl($eo_path, 'sifat-naskah', 'GET', [], $param);
        return json_decode($response);
    }

    public function getJenisLampiran($eo_path = '', $param = [])
    {
        $response = $this->curl($eo_path, 'jenis-lampiran', 'GET', [], $param);
        return json_decode($response);
    }

    public function sendSurat($eo_path = '', $data = [])
    {
        $response = $this->curl($eo_path, 'kirim-naskah', 'POST', $data);
        var_dump($response);
        return json_decode($response);
    }

}

?>