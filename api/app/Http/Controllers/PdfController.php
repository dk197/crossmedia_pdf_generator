<?php
namespace App\Http\Controllers;
use \mpdf;
use Illuminate\Http\Request;
use QRCode;

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
        
        return response()->json($request);

        $this->validate($request, [
            'cardWidth' => 'required',
            'cardHeight' => 'required',
            'name' => 'required'
        ]);

        $qrcodeData = [
            'name' => $request->input(['name']),
            'position' => $request->input(['position']),
            'firma' => $request->input(['firma']),
            'adresse' => $request->input(['adresse']),
            'telefon' => $request->input(['telefon']),
            'fax' => $request->input(['fax']),
            'email' => $request->input(['e-mail']),
            'website' => $request->input(['website']),
        ];

        if($request->input('dynamicQrCode') === 'on') {
            // generate vcard
            // make database entry
            // create specific url
            // create qrcode with the url
        }else {
            // generate static qrcode
            $qrcode = $this->generateStaticQrCode($qrcodeData);
        }

        $cardWidth = $request->input('cardWidth');
        $cardHeight = $request->input('cardHeight');

        $htmlInput = $request->input(['htmlInput']);

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

    public function generateStaticQrCode($data) {
        $oQRC = new QRCode; // Create vCard Object
        $oQRC->fullName($data['name']) // Add Full Name
            ->role($data['position'])
            ->organization($data['firma'])
            ->address($data['adresse'])
            ->workPhone($data['telefon'])
            ->email('ph7software@gmail.com') // Add Email Address
            ->finish(); // End vCard
        
        // echo '<p><img src="' . $oQRC->get(300) . '" alt="QR Code" /></p>'; // Generate and display the QR Code
        $oQRC->display(); // Display
    }
}
