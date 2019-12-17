<?php
namespace App\Http\Controllers;
use \mpdf;
use Illuminate\Http\Request;


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

    public function pdfGenerieren(Request $request)
    {
        header("Access-Control-Allow-Origin: *");

        $this->validate($request, [
            'cardWidth' => 'required',
            'cardHeight' => 'required'
        ]);

        $cardWidth = $request->input('cardWidth');
        $cardHeight = $request->input('cardHeight');

        $name = $request->input(['name']);
        $adress = $request->input(['adress']);

        $html = "<h1>Hallo</h1>";

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [$cardHeight, $cardWidth],
            'orientation' => 'L'
        ]);

        $mpdf->showImageErrors = true;
        $mpdf->debug = true;

        $mpdf->PDFXauto =  true;
        $mpdf->PDFX =  true;

        $mpdf->WriteHTML($html);
        $mpdf->Output('', 'I');
    }
}
