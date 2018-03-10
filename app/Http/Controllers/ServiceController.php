<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Reservation;
use App\Service;
use App\Venue;
use Mail;
 
class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::all();
        return response()->json($service, 201);
    }

    public function show()
    {
        $service = Service::all();
        return response()->json($service, 201);
    }


}