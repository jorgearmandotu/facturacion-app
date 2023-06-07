<?php

namespace App\Http\Controllers;

use App\Models\Cstate;
use App\Models\CtypesNotes;
use App\Models\Location;
use App\Models\Product;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index(){
        $products = Product::all();
        $types = CtypesNotes::all();
        $locations = Location::where('cstate_id', Cstate::where('value', 'Activo')->first()->id)->get();
        return view('admin.create_notes', compact('products', 'types', 'locations'));
    }
}
