<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class imageTTD {    
    function wrapimagettftext($img, $fontSize, $drawFrame, $textColor, $fontType, $text, $lineHeight = '', $wordSpacing = '', $hAlign = 0, $vAlign = 0)
    {
        if ($wordSpacing === ' ' || $wordSpacing === '') {
            $size = imagettfbbox($fontSize, 0, $fontType, ' ');
            $wordSpacing = abs($size[4] - $size[0]);
        }
        $size = imagettfbbox($fontSize, 0, $fontType, 'Zltfgyjp');
        $baseHeight = abs($size[5] - $size[1]);
        $size = imagettfbbox($fontSize, 0, $fontType, 'Zltf');
        $topHeight = abs($size[5] - $size[1]);

        if ($lineHeight === '' || $lineHeight === '') {
            $lineHeight = $baseHeight * 110 / 100;
        } else if (is_string($lineHeight) && $lineHeight{
            strlen($lineHeight) - 1} === '%') {
            $lineHeight = floatVal(substr($lineHeight, 0, -1));
            $lineHeight = $baseHeight * $lineHeight / 100;
        } else {
        }

        $usableWidth = $drawFrame[2] - $drawFrame[0];
        $usableHeight = $drawFrame[3] - $drawFrame[1];
        $leftX = $drawFrame[0];
        $centerX = $drawFrame[0] + $usableWidth / 2;
        $rightX = $drawFrame[0] + $usableWidth;
        $topY = $drawFrame[1];
        $centerY = $drawFrame[1] + $usableHeight / 2;
        $bottomY = $drawFrame[1] + $usableHeight;
        $text = explode(" ", $text);
        $line_w = -$wordSpacing;
        $line_h = 0;
        $total_w = 0;
        $total_h = 0;
        $total_lines = 0;
        $toWrite = array();
        $pendingLastLine = array();
        for ($i = 0; $i < count($text); $i++) {
            $size = imagettfbbox($fontSize, 0, $fontType, $text[$i]);

            $width = abs($size[4] - $size[0]);
            $height = abs($size[5] - $size[1]);

            $x = -$size[0] - $width / 2;
            $y = $size[1] + $height / 2;

            if ($line_w + $wordSpacing + $width > $usableWidth) {
                $lastLineW = $line_w;
                $lastLineH = $line_h;

                if ($total_w < $lastLineW) $total_w = $lastLineW;
                $total_h += $lineHeight;

                foreach ($pendingLastLine as $aPendingWord) {

                    if ($hAlign < 0) $tx = $leftX + $aPendingWord['tx'];
                    else if ($hAlign > 0) $tx = $rightX - $lastLineW + $aPendingWord['tx'];
                    else if ($hAlign == 0) $tx = $centerX - $lastLineW / 2 + $aPendingWord['tx'];

                    $toWrite[] = array('line' => $total_lines, 'x' => $tx, 'y' => $total_h, 'txt' => $aPendingWord['txt']);
                }
                $pendingLastLine = array();

                $total_lines++;
                $line_w = $width;
                $line_h = $height;

                $pendingLastLine[] = array('tx' => 0, 'w' => $width, 'h' => $height, 'x' => $x, 'y' => $y, 'txt' => $text[$i]);
            } else {

                $line_w += $wordSpacing;
                $pendingLastLine[] = array('tx' => $line_w, 'h' => $width, 'w' => $height, 'x' => $x, 'y' => $y, 'txt' => $text[$i]);
                $line_w += $width;
                if ($line_h < $height) $line_h = $height;
            }
        }
        $lastLineW = $line_w;
        $lastLineH = $line_h;
        if ($total_w < $lastLineW) $total_w = $lastLineW;
        $total_h += $lineHeight;
        foreach ($pendingLastLine as $aPendingWord) {

            if ($hAlign < 0) $tx = $leftX + $aPendingWord['tx'];
            else if ($hAlign > 0) $tx = $rightX - $lastLineW + $aPendingWord['tx'];
            else if ($hAlign == 0) $tx = $centerX - $lastLineW / 2 + $aPendingWord['tx'];

            $toWrite[] = array('line' => $total_lines, 'x' => $tx, 'y' => $total_h, 'txt' => $aPendingWord['txt']);
        }
        $pendingLastLine = array();
        $total_lines++;

        $total_h += $lineHeight - $topHeight;
        $last_y = 0;
        foreach ($toWrite as $aWord) {

            $posx = $aWord['x'];

            if ($vAlign < 0) $posy = $topY + $aWord['y'];
            else if ($vAlign > 0) $posy = $bottomY - $total_h + $aWord['y'];
            else if ($vAlign == 0) $posy = $centerY - $total_h / 2 + $aWord['y'];

            imagettftext($img, $fontSize, 0, $posx, $posy, $textColor, $fontType, $aWord['txt']);

            $last_y = $posy;
        }
        return $last_y;
    }

    function generate($namae,$nip,$jabatan){
        $img_width = 500;
        $img_height = 189;

        // Create Image From Existing File
        $jpg_image = imagecreatefrompng(APPPATH.'libraries/image_ttd/frame.png');
        $targetImage = imagecreatetruecolor($img_width, $img_height);
        imagealphablending($targetImage, false);
        imagesavealpha($targetImage, true);
        $black = imagecolorallocate($jpg_image, 0, 0, 0);
        $font_path = APPPATH.'libraries/image_ttd/times.ttf';
        $text = "Ditandatangani secara elektronik oleh :";
        imagettftext($jpg_image, 12, 0, 137, 20, $black, $font_path, $text);


        $drawFrame = array(137, 40, $img_width - 10, $img_height - 100);
        $fontType = APPPATH.'libraries/image_ttd/times_b.ttf';
        $fontSize = 16;
        $lineHeight = 32;
        $wordSpacing = ' ';
        $hAlign = -1; // -1:left  0:center 1:right
        $vAlign = -1; // -1:top  0:middle 1:bottom
        $ly = $this->wrapimagettftext($jpg_image, $fontSize, $drawFrame, $black, $fontType, $namae, '120%', ' ', $hAlign, $vAlign);

        $font_path = APPPATH.'libraries/image_ttd/times.ttf';
        imagettftext($jpg_image, 16, 0, 137, $ly + 25, $black, $font_path, $nip);


        $drawFrame = array(137, 130, $img_width - 10, $img_height - 15);
        $fontType = APPPATH.'libraries/image_ttd/times.ttf';
        $fontSize = 12;
        $lineHeight = 40;
        $wordSpacing = ' ';
        $hAlign = -1; // -1:left  0:center 1:right
        $vAlign = 1; // -1:top  0:middle 1:bottom
        $ly = $this->wrapimagettftext($jpg_image, $fontSize, $drawFrame, $black, $fontType, $jabatan, '120%', ' ', $hAlign, $vAlign);

        imagecopyresampled(
            $targetImage,
            $jpg_image,
            0,
            0,
            0,
            0,
            $img_width,
            $img_height,
            $img_width,
            $img_height
        );


        ob_start();
        imagepng($targetImage, null, 9);
        $base_64_ttd = base64_encode(ob_get_clean());
        imagedestroy($targetImage);
        return $base_64_ttd;
    }
}