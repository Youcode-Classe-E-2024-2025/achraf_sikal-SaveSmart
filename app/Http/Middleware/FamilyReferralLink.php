<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FamilyReferralLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = 'encryptkey111213';

        // Store the encryption key
        // $encryption_key = "SaveSmart";

        // // Use openssl_encrypt() function to encrypt the data
        // $encryption = openssl_encrypt($simple_string, $ciphering,
        //             $encryption_key, $options, $encryption_iv);

        $decryption_key = "SaveSmart";

        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($request, $ciphering,
                $decryption_key, $options, $encryption_iv);

        return $next($request);
    }
}
