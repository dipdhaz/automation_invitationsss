<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\PDFController;

class UserController extends Controller
{
    public function searchUser(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');

        // Search for a user with either NIK or Passport Number
        $user = User::where('nik', $query)
                    ->orWhere('nomor_paspor', $query)
                    ->first();

        if ($user) {
            // Call the fillPDFFile method from PDFController
            $pdfController = new PDFController();
            return $pdfController->fillPDFFile(public_path("invitation.pdf"), public_path("invitation.pdf"), $user);
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }
}

