<?php

// app/Http/Controllers/InvitationController.php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function generateInvitationPdf($recipientName, $electionDate)
    {
        // Create a new PDF instance
        $pdf = PDF::loadHTML(view('pdf.template', ['recipientName' => $recipientName, 'electionDate' => $electionDate])->render());

        // You can customize this method based on your needs
        $pdf->setPaper('A4', 'portrait');

        // Return the PDF as a response with headers
        return $pdf->stream('invitation.pdf');
    }
}

