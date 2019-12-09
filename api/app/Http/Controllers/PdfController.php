<?php

namespace App\Http\Controllers;
use \mpdf;

class PdfController extends Controller
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
    public function test() {
        print_r('test');
    }

    public function pdfGenerieren() {
        $hight = 51;
        $width = 89;
        $html = '<h1>Hallo</h1>';

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [$hight, $width],
            'orientation' => 'L'
        ]);
        $mpdf->PDFX =  true;
        $mpdf->WriteHTML($html);
        $mpdf->Output('visitCard.pdf', \Mpdf\Output\Destination::INLINE);
    }
}