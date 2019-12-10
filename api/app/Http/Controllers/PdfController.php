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
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            </head>
            <body style="margin: 0px; background-color: green;" >
                <div class="container" >
                    <div class="row">
                        <div class="col-xs-4">
                            <p style="font-size: 9">Jakob Schlagenhaufer</p>
                        </div>
                        <div class="col-xs-4">
                            <img height="30" class="img-responsive img-center" src="http://lehrerfortbildung-bw.de/u_matnatech/informatik/gym/bp2016/fb1/1_daten_code/2_kopier/1_einstieg/pics/qr-code.jpg"/>
                        </div>
                        <div class="col-xs-4">
                            <p style="font-size: 9">Altenseeweg 35<br>92536 Pfreimd</p>
                        </div>
                    </div>
                </div>
            </body>
        </html>
        <style>
            .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
                border:0;
                padding:0;
                margin-left:-0.00001;
            }
            .img-center {margin:0 auto;}
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
