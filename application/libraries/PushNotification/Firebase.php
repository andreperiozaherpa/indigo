<?php

class Firebase extends CI_Model{
 
    // sending push message to single user by firebase reg id
    public function send($to, $title, $message,$click_action='',$data_id='', $raw_data='') {
        $fields = array(
            'data'  => array(
                    'title' => $title,
                    'message'  => $message,
                    'click_action'  => $click_action,
                    'data_id'       => $data_id,
                    'raw_data'      => $raw_data,
                ),
            'priority'      => 'high',
            'to'            => $to
        );

        $param = array(
            'notification_id'   => strtoupper(uniqid("N-")),
            'title'             => $title,
            'message'           => $message,
            'ndate'             => date('Y-m-d'),
            'ntime'             => date('H:i:s'),
            'data'              => $click_action,
            'data_id'           => $data_id,
            'raw_data'          => $raw_data,
            'user_id'           => $this->getUserid($to)
        );
        $this->insertDb($param);

        return $this->sendPushNotification($fields);
    }

    private function insertDb($param)
    {
        $this->db->insert("notification",$param);
    }

    public function sendMulti($ids, $title, $message,$click_action='',$data_id='', $raw_data='') {
        $fields = array(
            'data'  => array(
                    'title' => $title,
                    'message'  => $message,
                    'click_action'  => $click_action,
                    'data_id'       => $data_id,
                    'raw_data'      => $raw_data,
                ),
            'priority'      => 'high',
            'registration_ids'   => $ids
        );

        foreach ($ids as $key => $app_token) {
            $param = array(
                'notification_id'   => strtoupper(uniqid("N-")).rand(1,999),
                'title'             => $title,
                'message'           => $message,
                'ndate'             => date('Y-m-d'),
                'ntime'             => date('H:i:s'),
                'data'              => $click_action,
                'data_id'           => $data_id,
                'raw_data'          => $raw_data,
                'user_id'           => $this->getUserid($app_token)
            );
            $this->insertDb($param);
        }
        return $this->sendPushNotification($fields);
    }
 
    private function getUserid($app_token)
    {
        $this->db->where("app_token",$app_token);
        $rs = $this->db->get("user")->row();
        if(!empty($rs->user_id)){
            return $rs->user_id;
        }
        else{
            return 0;
        }
    }
 
    // function makes curl request to firebase servers
    private function sendPushNotification($fields,$topics=false) {
         
        $FIREBASE_API_KEY = "AAAAGQEFU7g:APA91bGtqzMH5tWmnqLcAWnvxX90-TgXir4pSieQH1XX__RE2lSeJFLWkUtoZW_jcHGI-dyW21BrNj62A5XmIvOZtx0wTCQON--mVfGIx-QTqHz_Ed4XeHzNIMbQNU78g-cjK569ipnh";
 
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $Authorization = "key=".$FIREBASE_API_KEY;
//        if($topics){
            // belum dipake
//            $url = "https://fcm.googleapis.com/v1/projects/digital-office-smd/messages:send";
//            $Authorization = "bearer <TOKEN>";
//        }
 
        $headers = array(
            'Authorization: ' . $Authorization,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
 
        return $result;
    }
}
?>