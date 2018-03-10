<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Reservation;
use App\Service;
use App\Venue;
use Mail;
use Illuminate\Support\Facades\DB;
 
class ReservationController extends Controller
{

    public function index()
    {
        $reservation = Reservation::all();
        return response()->json($reservation, 201);
    }

    public function showReservationMonth(int $serviceId, String $month, String $year)
    {

        $reservationResult = DB::select(
            'SELECT * FROM reservations 
            WHERE 
                serviceId = ? 
                AND 
                (
                    ( YEAR(resStartDate) = ? )

                    OR

                    ( YEAR(resEndDate) = ? )

                )
            '
            ,[$serviceId, $year, $year]
        );
                     
        return response()->json($reservationResult, 201);

    }

    public function showReservationThisMonth(int $serviceId)
    {


        $reservationResult = DB::select(
            'SELECT * FROM reservations 
            WHERE 
                serviceId = ? 
                AND 
                (
                    -- (
                        ( YEAR(resStartDate) >= YEAR( CURDATE() ) )

                        OR

                        ( YEAR(resEndDate) >= YEAR( CURDATE() ) )

                    -- )
                    -- OR
                    -- (
                    --     ( YEAR( CURDATE() ) BETWEEN
                    --     YEAR(resStartDate) AND YEAR(resEndDate) )

                    -- )
                )

                '
            ,[$serviceId]
        );



        return response()->json($reservationResult, 201);
    }

    public function store(Request $request)
    {

        $reservation = Reservation::create($request->all());
        return response()->json($reservation, 201);
    }

}