<?php

namespace App\Http\Controllers\PublicController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AllCategories extends Controller
{
    public function index()
    {
    	return view('public.allcategory.index');
    }
}
