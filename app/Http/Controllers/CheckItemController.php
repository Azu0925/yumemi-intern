<?php

namespace App\Http\Controllers;

use App\Models\CheckItem;
use CategoryLists;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;

class CheckItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckItem  $checkItem
     * @return \Illuminate\Http\Response
     */
    public function show($hold_time)
    {
        $event_id = DB::table('events')
            ->select('id')
            ->where('hold_time', '=', $hold_time)
            ->get();
        
        $category_list = DB::table('category_lists')
            ->get()
            ->toArray();
        $check_items = DB::table('check_items')
            ->where('event_id', '=', $event_id[0]->id)
            ->get()
            ->toArray();

        foreach($check_items as $item){
             $item->category = ['hoge'];
            foreach($category_list as $category){
                //Logger(var_dump($item->id == $category->check_item_id));
                if($item->id == $category->check_item_id){
                    // Logger(var_dump($item->id == $category->check_item_id));
                    $item->category += array($category); 
                }
            }
        }
        return response()->json([
            'holdTime' => $hold_time,
            'items' => $check_items
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckItem  $checkItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckItem $checkItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckItem  $checkItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckItem $checkItem)
    {
        //
    }
}
