<?php

namespace App\Http\Controllers;
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
}
