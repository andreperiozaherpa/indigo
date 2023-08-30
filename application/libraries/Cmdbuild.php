<?php
class Cmdbuild
{
    public function __construct()
    {
        $CI = &get_instance();
        $this->base_url = $CI->config->item('urlApp');
        $this->api_url = $this->base_url . "/services/rest/v3/";
        $this->token_url = $this->api_url . "sessions?scope=service&returnId=true";
        $this->username = $CI->config->item('adminCmdbuild');
        $this->password = $CI->config->item('passwordCmdbuild');
        $this->group = $CI->config->item('groupUser');
    }

    private function curl($url, $data = array(), $token = null, $is_get_token = false)
    {

        $headers = ['Content-Type: application/json'];
        
        if ($is_get_token == false) {
            $headers[] = 'Cmdbuild-authorization: ' . $token;
        }else{
            $data = ["username"=>$this->username,"password"=>$this->password];
        }
        
        $curl_array = array(
            CURLOPT_URL => $this->api_url.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => $headers,
        );

        if(!empty($data)){
            $curl_array[CURLOPT_CUSTOMREQUEST] = 'POST';
            $curl_array[CURLOPT_POSTFIELDS] = json_encode($data);
        }else{
            $curl_array[CURLOPT_CUSTOMREQUEST] = 'GET';
        }

        $curl = curl_init();
        curl_setopt_array($curl, $curl_array);
        $response = curl_exec($curl);
        if(curl_errno($curl)){
            throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        return $response;
    }

    public function getToken()
    {
        try{
            $token = $this->curl('sessions?scope=service&returnId=true',[],null,true);
            $get = json_decode($token);
            if($get->success){
                $token = $get->data->_id;
                return trim($token);
            }else{
                return false;
            }
        } catch(Exception $e){
            return false;
        }
    }

    public function getByUsername($username){
        try{
            $token = $this->getToken();
            $get = $this->curl('users',[],$token);
            $get = json_decode($get,true);
            if($get['success']){
                $list_users = $get['data'];
                // print_r($list_users);
                //find key by username in list_users
                $key = array_search($username, array_column($list_users, 'username'));
                if($key !== false){
                    return $list_users[$key];
                }else{
                    return false;
                }
                
            }else{
                return false;
            }
        } catch(Exception $e){
            return false;
        }
    }

}