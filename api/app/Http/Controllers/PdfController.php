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

        $html = $htmlInput . '
        <img src="https://qrickit.com/api/qr.php?d=BEGIN%3aVCARD%0d%0aVERSION%3a3.0%0d%0aN%3aDoe%3bJohn%0d%0aORG%3aABC+Co.%0d%0aTITLE%3aPresident%0d%0aEMAIL%3ajohndoe%40email.com%0d%0aTEL%3bTYPE%3dCELL%3a5555555555%0d%0aTEL%3bTYPE%3dWORK%2cVOICE%3a5551231234%0d%0aNOTE%3aTest%0d%0aURL%3awww.abc.com%0d%0aADR%3a%3b%3bSuite+451+Main+St.%253bMiami%253bFlorida%253b123456%253bUSA%0d%0aEND%3aVCARD%0A&addtext=&txtcolor=000000&fgdcolor=000000&bgdcolor=FFFFFF&qrsize=200" alt="Smiley face" height="42" width="42">
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
