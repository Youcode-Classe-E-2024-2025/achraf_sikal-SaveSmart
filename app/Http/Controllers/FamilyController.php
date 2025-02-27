<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function join(Request $request){
        $incomingFields = $request->validate([
            'family_id'=> ['required']
        ]);
        $id = $incomingFields['family_id'];
        $ciphering = "AES-128-CTR";

        $options = 0;
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = 'encryptkey111213';

        $decryption_key = "SaveSmart";

        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($id, $ciphering, $decryption_key, $options, $encryption_iv);

        return view('family/join');
    }
}
