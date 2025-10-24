<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Qrcode extends BaseController
{
    public function generate($nip)
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($nip)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->labelText($nip)
            ->labelFont(new NotoSans(16))
            ->build();

        // Set Header dan Tampilkan
        header('Content-Type: '.$result->getMimeType());
        echo $result->getString();
    }
}
