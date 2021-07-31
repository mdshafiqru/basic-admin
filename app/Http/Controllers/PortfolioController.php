<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;

class PortfolioController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  // Show all portfolio
  public function Portfolio(){
    $portfolios = Multipic::latest()->take(6)->get();
    return view('pages.portfolio', compact('portfolios'));
  }



}
