<?php

namespace App\Http\Controllers;

use App\VCard as AppVCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JeroenDesloovere\VCard\VCard;

class VCardController extends Controller
{
    public function generateVcard() {
        // define vcard
        $vcard = new VCard();

        // define variables
        $lastname = 'Desloovere';
        $firstname = 'Jeroen';
        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        // add work data
        $vcard->addCompany('Siesqo');
        $vcard->addJobtitle('Web Developer');
        $vcard->addRole('Data Protection Officer');
        $vcard->addEmail('info@jeroendesloovere.be');
        $vcard->addPhoneNumber(1234121212, 'PREF;WORK');
        $vcard->addPhoneNumber(123456789, 'WORK');
        $vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
        $vcard->addLabel('street, worktown, workpostcode Belgium');
        $vcard->addURL('http://www.jeroendesloovere.be');


        // return vcard as a string
        // return $vcard->getOutput();
        $vcardString = $vcard->getOutput();
        return response($vcardString, '200')
            ->header('Content-Type', 'text/x-vcard');

        // return vcard as a download
        // return $vcard->download();
    }

    public function getUsersVCards() {
        $user = Auth::user();
        $vcards = AppVCard::where('user_id', $user->id)->get();
        return response()->json($vcards);
    }

    public function editVcard(Request $request) {
        // header("Access-Control-Allow-Origin: *");
        // print_r($request);
        $vcard = AppVCard::where('id', $request->id + 1)->get()->first();
        $vcard->name = $request->name;
        $vcard->position = $request->position;
        $vcard->firma = $request->firma;
        $vcard->adresse = $request->adresse;
        $vcard->telefon_privat = $request->telefon_privat;
        $vcard->telefon_geschaeftlich = $request->telefon_geschaeftlich;
        $vcard->email = $request->email;
        $vcard->webseite = $request->webseite;
        $vcard->save();
        return response()->json($vcard);
        // return response()->json($request->id);
    }
}
