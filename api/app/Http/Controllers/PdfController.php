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
        $height = 51;
        $width = 89;
        $html = '
        <html>
            <div class="Content">
            <div class="drag-it-dude" id="visitcardParent" style="padding-left: 123px; padding-top: 97px;">
                <div class="innerElement">Jakob Schlagenhaufer</div>
                <div class="innerElement">jakdf@mailksandfn.de</div>
            </div>
            </div>
        </html>
        <style>
            @page {
                margin: 0mm;
                margin-header: 0mm;
                margin-footer: 0mm;
            }

        </style>
        ';

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [$height, $width],
            'orientation' => 'L'
        ]);
        $mpdf->showImageErrors = true;
        $mpdf->debug = true;

        $mpdf->PDFXauto =  true;
        $mpdf->PDFX =  true;

        $mpdf->WriteHTML($html);
        $mpdf->Output('visitCard.pdf', \Mpdf\Output\Destination::INLINE);
    }
}
