<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function search(Request $request)
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
        return view('home', ['user' => $user]);
    } else {
        return redirect()->back()->with('error', 'User not found');
    }
}

}
