<?php
class Api_esign extends CI_Controller
{
    public function ttd()
    {
        $ch = curl_init();

        $paramData = array(
            'halaman' => 'PERTAMA',
            'image' => 'true',
            'jenis_response' => 'BYTE',
            'linkQR' => 'http://google.com',
            'nik' => '30122019',
            'passphrase' => '#4321qwer*',
            'tampilan' => 'INVISIBLE'
        );
        // curl_setopt($ch, CURLOPT_URL, 'http://124.158.169.179/api/sign/pdf?halaman=PERTAMA&image=true&jenis_response=BYTE&linkQR=http%3A%2F%2Fgppgle.cm&nik=30122019&passphrase=%234321qwer*&tampilan=INVISIBLE');
        curl_setopt($ch, CURLOPT_URL, 'http://124.158.169.179/api/sign/pdf?'.http_build_query($paramData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        $postData = array(
            'file' => curl_file_create('./data/sample.pdf', 'application/pdf'),
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_USERPWD, "admin:qwerty");

        // $headers = array();
        // $headers[] = 'Accept: */*';
        // $headers[] = 'Content-Type: multipart/form-data';
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            die;
        }
        curl_close($ch);
        
        $res = json_decode($result);
        if(isset($res->error)){
            echo $res->error;
        }else{
            file_put_contents('./data/sample_signed2xzz.pdf', $result);
            echo "sukses";
        }
        // print_r($res);
        //hasil
        // file_put_contents('/var/www/im/data/sample_signed2xz.pdf', $result);
        // //header PDF
        // header("Content-type:application/pdf");
        // header("Content-Disposition:attachment;filename='sample_signed2xz.pdf'");
        // echo $result;
    }
    
    private function parse_header($header){
        foreach (explode("\r\n", $header) as $i => $line)
        if ($i === 0)
            $headers['http_code'] = $line;
        else
        {
            list ($key, $value) = explode(': ', $line);

            $headers[$key] = $value;
        }
        return $headers;
    }
}
