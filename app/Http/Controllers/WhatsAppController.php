<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function handleWebhook(Request $request)
    {
        $message = $request->input('Body');  // Get the incoming message
        $from = $request->input('From');     // Sender's phone number

        // Example response logic
        $reply = $this->generateReply($message);

        // Send a reply via Twilio
        $this->twilio->messages->create(
            $from,
            [
                'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_NUMBER'),
                'body' => $reply
            ]
        );

        return response()->json(['status' => 'Message Sent']);
    }

    protected function generateReply($message)
    {
        // Simple reply logic
        if (strtolower($message) === 'hello') {
            return "Hi! How can I assist you today?";
        }

        return "Sorry, I didn't understand that. Please try again.";
    }

}
