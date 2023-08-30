<?php

include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");

use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();

use NcJoes\OfficeConverter\OfficeConverter;
use Ilovepdf\Ilovepdf;
use Ilovepdf\OfficepdfTask;

//error report true
error_reporting(E_ALL);
ini_set('display_errors', 1);


class Convert extends CI_Controller
{
    public function index()
    {
        $rendererName = Settings::PDF_RENDERER_TCPDF;
        $rendererLibraryPath = './application/libraries/tcpdf';


        // \PhpOffice\PhpWord\Settings::setPdfRendererPath($rendererLibraryPath);
        // \PhpOffice\PhpWord\Settings::setPdfRendererName($rendererName);

        // $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // //Open template and save it as docx
        // $document = $phpWord->loadTemplate('./encrypt/surat.docx');
        // $document->saveAs('./encrypt/temp2.docx');

        //Load temp file
        // $phpWord = \PhpOffice\PhpWord\IOFactory::load('./encrypt/temp2.docx');

        // //Save it
        // $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
        // $xmlWriter->save('./encrypt/result3.pdf');

        // $objReader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        // $contents = $objReader->load('./encrypt/surat.doc');
        $contents = \PhpOffice\PhpWord\IOFactory::load('./encrypt/surat.doc');

        // $rendername = \PhpOffice\PhpWord\Settings::PDF_RENDERER_TCPDF;

        if (!\PhpOffice\PhpWord\Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
            die("Provide Render Library And Path");
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($contents, 'PDF');
        $objWriter->save('./encrypt/result' . time() . '.pdf');
    }

    function c2()
    {
        $filename = 'output-filez' . time() . '.pdf';
        $converter = new OfficeConverter('./encrypt/surat5.docx');
        $converter->convertTo($filename);
        if ($converter) {
            echo '<a target="blank" href="' . base_url('encrypt/' . $filename) . '">' . $filename . '</a>';
        }
    }

    public function c3()
    {
        $myTask = new OfficepdfTask('project_public_8df836463375c9646918e380edbec1ac_QYv3c2d4840e13131e22f70dea04417cfc72f', 'secret_key_86defbeac4770ce1ce7a8907ecbb495e_CaKlZ7cd4cd167132db9b93a00797c1bc5905');
        // file var keeps info about server file id, name...
        // it can be used latter to cancel file
        $file = $myTask->addFile('./encrypt/surat5.docx');

        // process files
        $myTask->execute();

        // and finally download file. If no path is set, it will be downloaded on current folder
        $myTask->download();
    }

    public function c4()
    {

        echo '<form method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file">
            <input type="submit" value="submit">
        </form>';

        if (!empty($_FILES['file']['name'])) {
            //upload file code igniter
            $config['upload_path'] = './encrypt/';
            $config['allowed_types'] = 'docx|doc';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                $data = array('upload_data' => $this->upload->data());
                $srcFile = $config['upload_path'].$data['upload_data']['file_name'];; 
                $filename = 'converted_'.time().'.pdf';
                $destFile = './encrypt/'. $filename;
                // print_r($data);die;
                $url = 'https://psg4-word-view.officeapps.live.com/wv/WordViewer/request.pdf?WOPIsrc=http%3A%2F%2Fpsg4%2Dview%2Dwopi%2Ewopi%2Eonline%2Eoffice%2Enet%3A808%2Foh%2Fwopi%2Ffiles%2F%40%2FwFileId%3FwFileId%3D'.urlencode(base_url($srcFile)).'&access_token=1&access_token_ttl=0&type=downloadpdf';
        
                try {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $fp = fopen($destFile, 'w+');
                    fputs($fp, $data);
                    fclose($fp);
                    echo '<a target="blank" href="'.base_url('encrypt/'.$filename).'">'.$filename.'</a>';
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }




        // $srcFile = './encrypt/surat6.docx';
        // $filename = 'converted_'.time().'.pdf';
        // $destFile = './encrypt/'. $filename;

        // $url = 'https://psg4-word-view.officeapps.live.com/wv/WordViewer/request.pdf?WOPIsrc=http%3A%2F%2Fpsg4%2Dview%2Dwopi%2Ewopi%2Eonline%2Eoffice%2Enet%3A808%2Foh%2Fwopi%2Ffiles%2F%40%2FwFileId%3FwFileId%3D'.urlencode(base_url($srcFile)).'&access_token=1&access_token_ttl=0&type=downloadpdf';

        // try {
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $url);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //     $data = curl_exec($ch);
        //     curl_close($ch);
        //     $fp = fopen($destFile, 'w+');
        //     fputs($fp, $data);
        //     fclose($fp);
        //     echo '<a target="blank" href="'.base_url('encrypt/'.$filename).'">'.$filename.'</a>';
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        // }


    }

    public function test(){
        $this->load->library('imageTTD');
        $img = $this->imagettd->generate('test','a','a');
        echo '<img src="data:image/png;base64,'.$img.'">';
    }

    public function test_pdf(){
        $srcFile = './encrypt/surat5.docx';
        $this->load->library('wordPdf');
        $convert = $this->wordpdf->convert($srcFile);
        echo $convert;
    }
}
