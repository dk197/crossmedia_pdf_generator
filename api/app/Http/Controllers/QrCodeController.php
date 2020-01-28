<?php

namespace App\Http\Controllers;

use QRCode;

class QrCodeController extends Controller
{
    public function generateStaticQrCode() {
        
        $oQRC = new QRCode; // Create vCard Object
        $oQRC->fullName('Pierre-Henry Soria') // Add Full Name
            ->nickName('PH7') // Add Nickname
            ->gender('M') // Add Gender
            ->email('ph7software@gmail.com') // Add Email Address
            ->impp('phs_7@aol.com') // Add Instant Messenger
            ->url('http://ph-7.github.com') // Add URL Website
            ->note('Hello to all! I am a web developer. As hobbies I like climbing and swimming ...') // Add Note
            ->categories('developer,designer,climber,swimmer') // Add Categories
            ->photo('http://files.phpclasses.org/picture/user/1122955.jpg') // Add Avatar
            ->lang('en-US') // Add Language
            ->finish(); // End vCard
        
        // echo '<p><img src="' . $oQRC->get(300) . '" alt="QR Code" /></p>'; // Generate and display the QR Code
        $oQRC->display(); // Display
    }
}
