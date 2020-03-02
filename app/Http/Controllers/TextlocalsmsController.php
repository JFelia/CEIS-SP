<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextlocalsmsController extends Controller
{
	
	public function send(Request $request){
		// Authorisation details.
		$username = "feliajeffrey@gmail.com";
		$hash = "a0fc1aca095dafa0b9edafafd2dca953cd4fa981d9c7ef18a4645f23b6659bd5";

		// Config variables. Consult http://api.txtlocal.com/docs for more info.
		$test = "0";

		// Data for text message. This is the text message data.
		$sender = "Jeff Felia"; // This is who the message appears to be from.
		$numbers = $request->input('num'); // A single number or a comma-seperated list of numbers
		$message = $request->input('mess');
		// 612 chars or less
		// A single number or a comma-seperated list of numbers
		$message = urlencode($message);
		$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
		$ch = curl_init('http://api.txtlocal.com/send/?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); // This is the result from the API
		curl_close($ch);
		echo($result);
	}
}
