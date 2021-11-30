<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{  
    public function resetPassword(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
        ]);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            $response = [
                'status' => __($status),
                'bool' => true
            ];
        }else {
            $response = [
                'status' => __($status),
                'bool' => false
            ];
        }

        return response($response, 200);
    }
}
