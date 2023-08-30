<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
require_once dirname(__FILE__) . '/tcpdf/tcpdi.php';
  
class Pdf extends TCPDF
{
  public function Header() {
    // Get the current page break margin
    $bMargin = $this->getBreakMargin();

    // Get current auto-page-break mode
    $auto_page_break = $this->AutoPageBreak;

    // Disable auto-page-break
    $this->SetAutoPageBreak(false, 0);

    // Define the path to the image that you want to use as watermark.
    $img_file = realpath(APPPATH . 'libraries/belum_verifikasi.png');

    // Render the image
    $this->Image($img_file, 60, 100, 100, 50, '', '', '', false, 200, '', false, false, 0);

    // Restore the auto-page-break status
    $this->SetAutoPageBreak($auto_page_break, $bMargin);

    // Set the starting point for the page content
    $this->setPageMark();
  }
}
?>