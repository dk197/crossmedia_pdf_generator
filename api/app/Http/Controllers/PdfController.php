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
        // print_r($request);
        // return response()->json($request);


        $this->validate($request, [
            'cardWidth' => 'required',
            'cardHeight' => 'required'
        ]);

        $cardWidth = $request->input('cardWidth');
        $cardHeight = $request->input('cardHeight');

        // $htmlInput = $request->input(['htmlInput']);
        $htmlInput = '<div data-v-4a7fb514="" class="drag-it-dude" id="0-text"><div data-v-4a7fb514="" class="innerElement">test</div></div><div data-v-4a7fb514="" class="drag-it-dude" id="1-text"><div data-v-4a7fb514="" class="innerElement"></div></div><div data-v-4a7fb514="" class="drag-it-dude" id="2-text"><div data-v-4a7fb514="" class="innerElement"></div></div><div data-v-4a7fb514="" class="drag-it-dude" id="3-text"><div data-v-4a7fb514="" class="innerElement"></div></div><div data-v-4a7fb514="" class="drag-it-dude" id="4-text"><div data-v-4a7fb514="" class="innerElement"></div></div><div data-v-4a7fb514="" class="drag-it-dude" id="5-text"><div data-v-4a7fb514="" class="innerElement"></div></div><div data-v-4a7fb514="" class="drag-it-dude" id="6-text"><div data-v-4a7fb514="" class="innerElement"></div></div><div data-v-4a7fb514="" class="drag-it-dude" id="7-text"><div data-v-4a7fb514="" class="innerElement"></div></div><div data-v-4823d924="" class="drag-it-dude" id="0-img" style="display: none;"><div data-v-4823d924="" class="innerElement"><img data-v-4823d924="" src="https://qrickit.com/api/qr.php?d=BEGIN%3aVCARD%0d%0aVERSION%3a3" width="50px"></div></div><div data-v-4823d924="" class="drag-it-dude" id="1-img"><div data-v-4823d924="" class="innerElement"><img data-v-4823d924="" width="50px"></div></div>';

        $html = $htmlInput . '
        <style>
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
