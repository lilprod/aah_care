<?php

namespace App\Http\Controllers;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoCompleteController extends Controller
{

    /* AJAX request */

    public function getAutocompleteData(Request $request)
    { 
        $search = $request->search;

        if($search == ''){
            $cities = City::orderby('title','asc')->select('id','title')->limit(5)->get();
        }else{
            $cities = City::orderby('title','asc')->select('id','title')->where('title', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();

        foreach($cities as $city){
            $response[] = array("value"=>$city->id,"label"=>$city->title);
           //$response[] = array("value"=>$city->name,"label"=>$city->name);
        }

        return response()->json($response);
    }

    public function search(Request $request){
        // check if ajax request is coming or not
        if($request->ajax()) {
            $query = $request->get('ville');
            // select country name from database
            $data = DB::table('cities')
                            ->where('title', 'like', $query.'%')
                            ->get();
            // declare an empty array for output
            $output = '';
            // if searched countries count is larager than zero
            if (count($data) > 0) {
                // concatenate output to the array
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                // loop through the result array
                foreach ($data as $row){
                    // concatenate output to the array
                    $output .= '<li class="list-group-item" data-id="'.$row->title.'">'.$row->title.'</li>';
                }
                // end of output
                $output .= '</ul>';
            }
            else {
                // if there's no matching results according to the input
                $output .= '<li class="list-group-item">'.'No city found'.'</li>';
            }
            // return output result array
            return $output;
        }
    }
}
