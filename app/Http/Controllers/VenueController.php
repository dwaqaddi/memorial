<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Reservation;
use App\Service;
use App\Venue;
use Mail;
 
class VenueController extends Controller
{
    public function index()
    {
        $venue = Venue::all();
        return response()->json($venue, 201);
    }

    public function show()
    {
        $venue = Venue::all();
        return response()->json($venue, 201);
    }


}