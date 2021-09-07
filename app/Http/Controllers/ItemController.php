<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Item::orderBy("created_at",'DESC')->get();
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request ->item["name"];
        $newItem->save();

        return $newItem;

    }

    

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $existingItem = Item::find($id);

       if ($existingItem){     
           $existingItem->done = $request->item["done"] ? 1:0;
           $existingItem->save();
           return $existingItem;
          
       }        

       return "Item not found.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = Item::find($id);

        if ($existingItem){
            $existingItem->delete();
            
            return "Item deleted";
        }
 
        return "Item not found.";
    }
}
