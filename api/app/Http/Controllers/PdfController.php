<?php
namespace App\Http\Controllers;

use App\VCard;
use \mpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JeroenDesloovere\VCard\VCard as JeroenDesloovereVCardVCard;
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
        // if (!file_exists('uploads/')) {
        //     mkdir('uploads/', 0777, true);
        // }
        // $uniqueIdent = uniqid();
        // $target_dir = "uploads/";
        // $target_file = $target_dir . $uniqueIdent . basename($_FILES['fileToUpload']['name']);
        // move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

        header("Access-Control-Allow-Origin: *");
        echo Auth::user();
        return;
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

        $qrSize = $request->input(['qrSize']);

        if($request->input('dynamicQrCode') === 'on') {
            $vcardId = $this->insertVCardInformation($qrcodeData);
            $ngrok = 'http://d152355e.ngrok.io';
            $url = $ngrok.'/api/getvcard/'.$vcardId;
            $encodedUrl = urlencode($url);
            $qrcode = '<img src="https://chart.googleapis.com/chart?chs='.$qrSize.'x'.$qrSize.'&cht=qr&chl='.$encodedUrl.'&choe=UTF-8">';
        }else {
            $qrcode = $this->generateStaticQrCode($qrcodeData, $qrSize);
        }
        echo $qrcode;
        return;
        $cardWidth = $request->input('cardWidth');
        $cardHeight = $request->input('cardHeight');

        $htmlInput = $request->input(['htmlInput']);

        //replace src from blob to the temp. Filepath
        // $search = '/src="blob:http(.*?")/';
        // $replace = 'src="' . $target_file . '"';
        // $string = $htmlInput;
        // $htmlInput = preg_replace($search,$replace,$string);

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
        // unlink($target_file);
    }

    public function insertVCardInformation($data) {
        $vcard = new VCard();
        $vcard->user_id = Auth::user()->id;
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

    public function generateStaticQrCode($data, $qrSize) {
        $oQRC = new QRCode; 

        $oQRC->fullName($data['name']) 
            ->role($data['position'])
            ->organization($data['firma'])
            ->address($data['adresse'])
            ->workPhone($data['telefon_geschaeftlich'])
            ->homePhone($data['telefon_privat'])
            ->email($data['email']); 
        
        if($data['website'] !== '') {
            $oQRC->url($data['website']); 
        }

        $oQRC->finish(); 

        return '<img src="' . $oQRC->get($qrSize) . '"/>';
    }

    public function getDynamicVcard($id) {
        $vcardModel = VCard::where('id', $id)->get()->first();
        $vcard = new JeroenDesloovereVCardVCard();

        $vcard->addName($vcardModel->name);
        $vcard->addCompany($vcardModel->firma);
        $vcard->addRole($vcardModel->position);
        $vcard->addEmail($vcardModel->email);
        $vcard->addPhoneNumber($vcardModel->telefon_privat, 'Privat');
        $vcard->addPhoneNumber($vcardModel->telefon_geschaeftlich, 'WORK');
        $vcard->addAddress(null, null, null, null, null, null, $vcardModel->adresse);
        $vcard->addURL($vcardModel->webseite);

        $vcardString = $vcard->getOutput();

        return response($vcardString, '200')
            ->header('Content-Type', 'text/x-vcard');
    }
}
