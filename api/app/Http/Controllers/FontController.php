<?php

namespace App\Http\Controllers;
use \mpdf;

class FontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function fontsAktuallisieren()
    {
        echo "Starte Fontaktuallisierung . . .";

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/custom/font/directory',
            ]),
            'fontdata' => $fontData + [
                'frutiger' => [
                    'R' => 'Frutiger-Normal.ttf',
                    'I' => 'FrutigerObl-Normal.ttf',
                ]
            ],
            'default_font' => 'frutiger'
        ]);
    }
}
