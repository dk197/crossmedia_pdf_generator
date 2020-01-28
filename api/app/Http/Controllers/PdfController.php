<?php
namespace App\Http\Controllers;

use App\VCard;
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
        //save the file for Pdf generation
        if (!file_exists('uploads/')) {
            mkdir('uploads/', 0777, true);
        }
        $uniqueIdent = uniqid();
        $target_dir = "uploads/";
        $target_file = $target_dir . $uniqueIdent . basename($_FILES['fileToUpload']['name']);
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

        header("Access-Control-Allow-Origin: *");
        
        // return response()->json($request);

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
            'telefon_privat' => $request->input(['telefon_privat']),
            'telefon_geschaeftlich' => $request->input(['telefon_geschaeftlich']),
            'email' => $request->input(['e-mail']),
            'website' => $request->input(['webseite']),
        ];

        if($request->input('dynamicQrCode') === 'on') {
            // generate vcard
            // make database entry
            // create specific url
            // create qrcode with the url
            $vcardId = $this->insertVCardInformation($qrcodeData);
            $url = 'http://2c94cc02.ngrok.io/getvcard/'.$vcardId;
            $encodedUrl = urlencode($url);
            $qrcode = '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$encodedUrl.'&choe=UTF-8">';
        }else {
            // generate static qrcode
            $qrcode = $this->generateStaticQrCode($qrcodeData);
            // print_r($qrcode);
            // return;
        }

        $cardWidth = $request->input('cardWidth');
        $cardHeight = $request->input('cardHeight');

        $htmlInput = $request->input(['htmlInput']);

        //replace src from blob to the temp. Filepath
        $search = '/src="blob:http(.*?")/';
        $replace = 'src="' . $target_file . '"';
        $string = $htmlInput;
        $htmlInput = preg_replace($search,$replace,$string);

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
        
        //delete temp file
        unlink($target_file);
    }

    public function insertVCardInformation($data) {
        $vcard = new VCard();
        $vcard->name = $data['name'];
        $vcard->position  = $data['position'];
        $vcard->firma = $data['firma'];
        $vcard->adresse = $data['adresse'];
        $vcard->telefon_privat = $data['telefon_privat'];
        $vcard->telefon_geschaeftlich = $data['telefon_geschaeftlich'];
        $vcard->email = $data['email'];
        $vcard->webseite = $data['website'];
        $vcard->save();

        return $vcard->id;
    }

    public function generateStaticQrCode($data) {
        $oQRC = new QRCode; 
        $oQRC->fullName($data['name']) 
            ->role($data['position'])
            ->organization($data['firma'])
            ->address($data['adresse'])
            ->workPhone($data['telefon_geschaeftlich'])
            ->homePhone($data['telefon_privat'])
            ->email($data['email']) 
            ->url($data['website']) 
            ->finish(); 
        
        return '<img src="' . $oQRC->get(300) . '" alt="QR Code" />';

        // echo '<p><img src="' . $oQRC->get(300) . '" alt="QR Code" /></p>'; // Generate and display the QR Code
        // $oQRC->display(); // Display
    }
}
