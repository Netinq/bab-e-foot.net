<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $uuid = Auth::id();
        $qr = QrCode::size(500)->generate(route('qr', $uuid));
        return view('profil.index', compact('qr'));
    }
}
