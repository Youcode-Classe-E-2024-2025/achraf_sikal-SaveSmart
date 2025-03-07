<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\User;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function join(Request $request)
    {
        $incomingFields = $request->validate([
            'family_id' => ['required'],
        ]);
        $id = $incomingFields['family_id'];
        $ciphering = 'AES-128-CTR';

        $options = 0;
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = 'encryptkey111213';

        $decryption_key = 'SaveSmart';

        // Use openssl_decrypt() function to decrypt the data
        $decryption = openssl_decrypt($id, $ciphering, $decryption_key, $options, $encryption_iv);
        User::where('id', auth()->user()->id)->update(['family_id' => $decryption]);

        return view('family/join');
    }

    public function create(Request $request)
    {
        $incomingFields = $request->validate([
            'family_name' => ['required', 'min:3'],
        ]);
        $incomingFields['name'] = $incomingFields['family_name'];
        $family = Family::create($incomingFields);
        auth()->user()->family()->associate($family)->save();

        return redirect('/');
    }
}
