<?php
namespace App\Http\Controllers\PublicController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
    	return view('public.terms-service.index');
    }
}
