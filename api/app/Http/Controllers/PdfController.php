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

        $htmlInput = $request->input(['htmlInput']);

        // $htmlInput = '
        // <div data-v-4a7fb514="" class="drag-it-dude" id="0" style="left: 56px; top: 76px; font-size: x-large; font-family: Futura;">
        //     <div data-v-4a7fb514="" class="innerElement">Jakob Schlagenhaufer</div>
        // </div>
        // <div data-v-4a7fb514="" class="drag-it-dude" id="1" style="left: 184px; top: 101px; font-size: x-small; font-family: Verdana;">
        //     <div data-v-4a7fb514="" class="innerElement">
        //     www.spasti.com
        //     </div>
        // </div>';

        $html = $htmlInput . '
        <style>
        @page {
            margin: 0mm;
            margin-header: 0mm;
            margin-footer: 0mm;
        }
        .drag-it-dude {
            position: absolute;
        }
        </style>';

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
