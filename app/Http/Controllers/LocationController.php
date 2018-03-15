<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Block;
use App\BlockType;
use App\BlockSection;
use App\Lot;
use App\Section;
use App\Reservation;
use App\Service;
use App\Venue;
use Mail;
use Illuminate\Support\Facades\DB;
 
class LocationController extends Controller
{

    public function index()
    {
        $reservation = Lot::all();
        return response()->json($reservation, 201);
    }

    public function showBlockSections()
    {

        $locations = BlockSection::all();
                     
        return response()->json($locations, 201);

    }

    public function showBlockTypes()
    {

        $locations = BlockType::all();
                     
        return response()->json($locations, 201);

    }

    public function showBlocks()
    {

        $locations = Block::
                        where('lat', '>', 0)
                        ->where('lng', '>', 0)
                        ->where('lat', '!=', '')
                        ->where('lng', '!=', '')
                        ->whereNotNull('lat')
                        ->whereNotNUll('lng')
                        ->get();
                     
        return response()->json($locations, 201);

    }

    public function showBlocksReservations(){

       $locations = DB::select(
            'SELECT s.*, 
                IFNULL(s.resId, 0) resId,
                IFNULL(s.blockId, 0) blockId,  
                IFNULL(s.userId, 0) userId, 
                IFNULL(s.serviceId, 0) serviceId, 
                IFNULL(s.venueId, 0) venueId, 
                IFNULL(s.lotId, 0) lotId,
                IFNULL(s.resIsUserVerified, 0) resIsUserVerified, 
                IFNULL(s.resIsAdminAccepted, 0) resIsAdminAccepted
                FROM 
                    (SELECT 
                        b.blocksLocationsId,
                        b.lat,
                        b.lng,
                        b.isWayFind,

                        bs.blockId,
                        bs.sectionId,
                        bs.blockTypeId,
                        bs.blockNumber,

                        bt.blockTypeName,
                        bt.blockTypeLotNum,

                        sec.sectionName,

                        r.resId,
                        r.userId,
                        r.serviceId,
                        r.venueId,
                        r.lotId,
                        r.resStartDate,
                        r.resEndDate,
                        r.resIsUserVerified,
                        r.resIsAdminAccepted,
                        r.created_at,
                        r.updated_at

                    FROM Blocks b

                    LEFT JOIN BlockSections bs
                    ON b.blocksLocationsId = bs.blockNumber

                    LEFT JOIN blockTypes bt
                    ON bs.blockTypeId = bt.blockTypeId

                    LEFT JOIN sections sec
                    ON bs.sectionId = sec.sectionsId

                    LEFT JOIN reservations r
                    ON bs.blockNumber = r.blockId) s
                
                 '
            ,[]
        );

       return response()->json($locations, 201);

    }

    public function showLots()
    {

        $locations = Lot::where('lotLat', '>', 0)
                        ->where('lotLng', '>', 0)
                        ->where('lotLat', '!=', '')
                        ->where('lotLng', '!=', '')
                        ->whereNotNull('lotLat')
                        ->whereNotNUll('lotLng')
                        ->get();
                     
        return response()->json($locations, 201);

    }

    public function showLot_Info(int $lotId){

               $locations = DB::select(
            '       
                    SELECT
                    
                        l.lotId,
                        
                        b.lat,
                        b.lng,
                        b.isWayFind,

                        bs.blockId,
                        bs.sectionId,
                        bs.blockTypeId,
                        bs.blockNumber,

                        bt.blockTypeName,
                        bt.blockTypeLotNum,

                        sec.sectionName

                    FROM lots l

                    LEFT JOIN Blocks b
                    ON l.blockId = b.blocksLocationsId

                    LEFT JOIN BlockSections bs
                    ON b.blocksLocationsId = bs.blockNumber

                    LEFT JOIN blockTypes bt
                    ON bs.blockTypeId = bt.blockTypeId

                    LEFT JOIN sections sec
                    ON bs.sectionId = sec.sectionsId

                    WHERE l.lotId = ?

                 '
            ,[$lotId]
        );

       return response()->json($locations, 201);
    }

    public function showLots_blockId(int $blockId)
    {

        $locations = Lot::where('blockId', $blockId)->get();
                     
        return response()->json($locations, 201);

    }

    public function showLots_blockId_free(int $blockId)
    {

        $locations = DB::select(
            'SELECT lotId, blockId FROM lots 
                WHERE blockId = ?
                AND lotId NOT IN 
                (SELECT lotId FROM reservations)

            UNION ALL

            SELECT lotId,blockId FROM reservations 
                WHERE lotId IN 
                (SELECT lotId FROM lots WHERE blockId = ?)

            ORDER BY lotId ASC

            '
            ,[$blockId, $blockId]
        );
                     
        return response()->json($locations, 201);

    }

    public function updateLots(Request $request, int $lotId){
        
        $locations = Lot::where('lotId', $lotId)->first();
        $locations->update($request->all());
        return response()->json($user, 200);

    }

    public function showSections()
    {

        $locations = Section::all();
                     
        return response()->json($locations, 201);

    }






}