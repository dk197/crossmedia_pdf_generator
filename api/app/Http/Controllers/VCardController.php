<?php

namespace App\Http\Controllers;

use App\VCard as AppVCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JeroenDesloovere\VCard\VCard;

class VCardController extends Controller
{
    public function getUsersVCards() {
        $user = Auth::user();
        $vcards = AppVCard::where('user_id', $user->id)->get();
        return response()->json($vcards);
    }

    public function editVcard(Request $request) {
        $vcard = AppVCard::where('id', $request->id)->get()->first();
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
    }

    public function deleteVCard($id) {
        AppVCard::destroy($id);
        return response()->json('success');
    }
}
