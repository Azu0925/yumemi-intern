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
            ->join('categories', 'category_lists.category_id', '=', 'categories.id')
            ->select('category_lists.id', 'category_lists.check_item_id', 'categories.name', 'categories.item')
            ->get();

        $check_items = DB::table('check_items')
            ->where('event_id', '=', $event_id[0]->id)
            ->get()
            ->toArray();

        $check_items_array = [];
        foreach($check_items as $item){
            $item->category_list = [];
            foreach($category_list as $category){
                if($item->id == $category->check_item_id){
                    $item->category_list[] = [
                        'name' => $category->name,
                        'param' => $category->item
                    ]; 
                }
            }
            $check_items_array[] = [
                'itemId' => $item->id,
                'title' => $item->title,
                'detail' => $item->detail,
                'eventId' => $item->event_id,
                'categoryList' => $item->category_list,
            ];
        }
        return response()->json([
            'holdTime' => $hold_time,
            'items' => $check_items_array
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
