<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChecklistRequest;
use App\Models\Check;

class CheckController extends Controller
{
    public function create(ChecklistRequest $request, String $hold_time){
        info("checkController");
        if(auth()->user() == null){
            return response()->json(['message' => 'null'], 400);
        }
        $user_id = auth()->user()->id;
        $item_id = $request->get('itemId');
        $event_id = intval($hold_time);

        $data = [];
        foreach($item_id as $id){
            $data[] = [
                'user_id' => $user_id,
                'check_item_id' => $id,
                'event_id' => $hold_time
            ];
        }
        //Check::insert($data);
        return response()->json(["itemId" => $request->get('itemId')]);
    }
}
