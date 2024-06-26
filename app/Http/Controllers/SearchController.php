<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\MOU;

class SearchController extends Controller
{
    public function index()
    {
        // $data = \DB::table('people')->paginate(10);
        $departments = Department::pluck('dep_name', 'dep_id');
        return view('search', compact('departments'));
    }

    public function advance(Request $request)
    {
        if (is_null($request->subject) && is_null($request->start_date) && is_null($request->end_date) && is_null($request->mou_no) && is_null($request->mou_year) && is_null($request->dep_id) ) {
            $data = MOU::all()->sortBy('mou_no')->sortByDesc('mou_year');
        }
        if( $request->subject){
            $data = MOU::where('subject', 'LIKE', "%" . $request->subject . "%")->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if( $request->subject && $request->start_date && $request->end_date){
            $data = MOU::where('subject', 'LIKE', "%" . $request->subject . "%")->where('start_date', '>=', $request->start_date)->where('end_date', '<=', $request->end_date)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if( $request->subject && $request->start_date){
            $data = MOU::where('subject', 'LIKE', "%" . $request->subject . "%")->where('start_date', '=', $request->start_date)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if( $request->subject && $request->end_date){
            $data = MOU::where('subject', 'LIKE', "%" . $request->subject . "%")->where('end_date', '=', $request->end_date)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if( $request->mou_no){
            $data = MOU::where('mou_no', $request->mou_no)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if ($request->mou_year) {
            $data = MOU::where('mou_year', $request->mou_year)->orderByRaw('LENGTH(mou_no) ASC')->orderBy('mou_no')->get();
        }

        if ($request->mou_no && $request->mou_year) {
            $data = MOU::where('mou_no', $request->mou_no)->where('mou_year', $request->mou_year)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if( $request->start_date){
            $data = MOU::where('start_date', '=', $request->start_date)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if( $request->end_date){
            $data = MOU::where('end_date', '=', $request->end_date)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if( $request->start_date && $request->end_date ){
            $data = MOU::where('start_date', '>=', $request->start_date)->where('end_date', '<=', $request->end_date)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        if($request->dep_id){
            $data = MOU::where('dep_id', '=', $request->dep_id)->orderBy('mou_year', 'asc')->orderBy('mou_no', 'asc')->get();
        }

        // if (!isset($data)) {
        //     $data = MOU::whereNotNull('created_at')->get();
        // }

        return view('search_results', compact('data'));
    }
}
