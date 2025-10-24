<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\ModelPegawai;

class QrcodePegawai extends Controller
{
    protected $modelPegawai;
    public function __construct()
    {
        $this->modelPegawai = new ModelPegawai();
    }

    public function index()
    {
        $data = [
            'judul' => 'QR Code Pegawai',
            'menu' => 'qrcodepegawai',
            'page' => 'QrcodePegawai/v_qrcodepegawai',
            'pegawai' => $this->modelPegawai->getPegawai(),
        ];
        return view('v_templete', $data);
    }

    
    public function generate($nip)
    {
        $result = (new Builder(new PngWriter()))
            ->data($nip)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->labelText("NIP: $nip")
            ->labelFont(new NotoSans(16))
            ->build();

        return $this->response
            ->setHeader('Content-Type', $result->getMimeType())
            ->setBody($result->getString());
    }
}
