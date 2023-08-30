<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PhpWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\PDF;

// include_once(APPPATH."third_party/dompdf-0.8.3/src/Autoloader.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Dompdf.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Options.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/CanvasFactory.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FontMetrics.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Css/Stylesheet.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Css/Style.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Css/AttributeTranslator.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Css/Color.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Frame/FrameTree.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Frame/FrameTreeList.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Frame/Factory.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FrameDecorator/Page.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FrameDecorator/Text.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FrameReflower/Text.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FrameReflower/Page.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FrameDecorator/Block.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FrameDecorator/Inline.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FrameReflower/Block.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Positioner/Block.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Positioner/Inline.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/FrameReflower/Inline.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/LineBox.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Frame/FrameTreeIterator.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Canvas.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Frame.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Helpers.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/lib/Cpdf.php");
// include_once(APPPATH."third_party/dompdf-0.8.3/src/Adapter/CPDF.php");
use Dompdf\Dompdf as DompdfLib;
use PhpOffice\PhpWord\Writer\WriterInterface;

/**
 * DomPDF writer
 *
 * @see  https://github.com/dompdf/dompdf
 * @since 0.10.0
 */
class DomPDF extends AbstractRenderer implements WriterInterface
{
    /**
     * Name of renderer include file
     *
     * @var string
     */
    protected $includeFile = APPPATH."third_party/dompdf-0.6.2/include/autoload.inc.php";

    /**
     * Save PhpWord to file.
     *
     * @param string $filename Name of the file to save as
     */
    public function save($filename = null)
    {
        $fileHandle = parent::prepareForSave($filename);

        //  PDF settings
        $paperSize = 'A4';
        $orientation = 'portrait';

        //  Create PDF
        $pdf = new \Dompdf\Dompdf();
        $pdf->setPaper(strtolower($paperSize), $orientation);
        $pdf->loadHtml(str_replace(PHP_EOL, '', $this->getContent()));
        $pdf->render();

        //  Write to file
        fwrite($fileHandle, $pdf->output());

        parent::restoreStateAfterSave($fileHandle);
    }
}
