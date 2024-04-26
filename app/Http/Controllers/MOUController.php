<?php

namespace App\Http\Controllers;

use App\Models\MOU;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;

class MOUController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $MOUs = MOU::all();
        $departments = Department::pluck('dep_name', 'dep_id');

        #1
        if (is_null($request->input('dep_id')) && is_null($request->input('start_date')) && is_null($request->input('end_date')) && is_null($request->input('active_date'))) $MOUs = MOU::all()->sortByDesc('created_at')->sortByDesc('updated_at');

        #2
        if (!is_null($request->input('dep_id')) && is_null($request->input('start_date')) && is_null($request->input('end_date')) && is_null($request->input('active_date'))) $MOUs = MOU::where('dep_id', $request->input('dep_id'))->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();

        #3
        if (!is_null($request->input('dep_id')) && !is_null($request->input('start_date')) && !is_null($request->input('end_date')) && is_null($request->input('active_date'))) $MOUs = MOU::where('dep_id', $request->input('dep_id'))->where('start_date', '>=', $request->input('start_date'))->where('end_date', '<=', $request->input('end_date'))->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();

        #4
        if (!is_null($request->input('dep_id')) && is_null($request->input('start_date')) && !is_null($request->input('end_date')) && is_null($request->input('active_date'))) $MOUs = MOU::where('dep_id', $request->input('dep_id'))->where('end_date', '<=', $request->input('end_date'))->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();

        #5
        if (is_null($request->input('dep_id')) && is_null($request->input('start_date')) && !is_null($request->input('end_date')) && is_null($request->input('active_date'))) $MOUs = MOU::where('end_date', '<=', $request->input('end_date'))->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();

        #6
        if (!is_null($request->input('dep_id')) && is_null($request->input('start_date')) && is_null($request->input('end_date')) && !is_null($request->input('active_date'))) $MOUs = MOU::where('dep_id', $request->input('dep_id'))->where('end_date', '>=', $request->input('active_date'))->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();

        #7
        if (is_null($request->input('dep_id')) && is_null($request->input('start_date')) && is_null($request->input('end_date')) && !is_null($request->input('active_date'))) $MOUs = MOU::where('end_date', '>=', $request->input('active_date'))->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();

        #8
        if (is_null($request->input('dep_id')) && !is_null($request->input('start_date')) && !is_null($request->input('end_date')) && is_null($request->input('active_date'))) $MOUs = MOU::where('start_date', '>=', $request->input('start_date'))->where('end_date', '<=', $request->input('end_date'))->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();

        #9
        if (is_null($request->input('dep_id')) && is_null($request->input('start_date')) && is_null($request->input('end_date')) && is_null($request->input('active_date')) && !is_null($request->input('mou_year'))) $MOUs = MOU::where('mou_year', $request->input('mou_year'))->orderBy('mou_no', 'asc')->get();

        $minYear = $mou_query = MOU::select('mou_year')->orderBy('mou_year', 'ASC') ->first();
        $maxYear = $mou_query = MOU::select('mou_year')->orderBy('mou_year', 'DESC') ->first();

        return view('mou.index', compact('MOUs', 'departments', 'minYear', 'maxYear'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $currentYearTH = now()->year+543;
        $currentYearTH = Carbon::now()->year + 543;

        $currentYear = Carbon::now()->year;
        $startDate = $currentYear . '-08-01';
        $endDate = $currentYear + 1 . '-07-31';
        $current_date = Carbon::now();

        if ($current_date >= $startDate) {
            $currentYearTH = $currentYearTH + 1;
        } else if ($current_date <= $startDate) {
            $currentYearTH;
        }

        $exists = MOU::where('mou_year', $currentYearTH)->exists();
        $mou_query = MOU::select('mou_no', 'mou_year')->orderBy('mou_year', 'DESC')->orderBy('mou_no', 'DESC') ->first();
        $mou_no_last = $mou_query->mou_no;
        $mou_year_last = $mou_query->mou_year;

        if ($exists) {
            $mou_no = $mou_query->mou_no + 1;
        } else {
            $mou_no = 1;
        }

        $departments = Department::pluck('dep_name', 'dep_id');
        $countries = Country::pluck('ct_nameENG', 'ct_code');
        // $currentYear = Carbon::now()->year;
        return view('mou.create', compact('departments', 'countries', 'currentYearTH', 'mou_no', 'mou_no_last', 'mou_year_last'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mou_no' => 'required',
            'subject' => 'required',
            'ext_department' => 'required',
            'status' => 'required',
            'mou_type' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        // Handle file upload
        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $filePath = $file->store('uploads', 'public');
        // }
        if ($file = $request->file('file')) {
            $file_name =time().$file->getClientOriginalName();
            $file->move('uploads', $file_name);
        }

        // MOU::create($request->all());
        MOU::create([
            'mou_no' => $request->input('mou_no'),
            'mou_year' => $request->input('mou_year'),
            'subject' => $request->input('subject'),
            'ext_department' => $request->input('ext_department'),
            'dep_id' => $request->input('dep_id'),
            'country' => $request->input('ct_code'),
            'status' => $request->input('status'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'file_path' => $file_name ?? null,
            'mou_type' => $request->input('mou_type'),
        ]);

        session()->flash('success', 'MOU created successfully.');

        return redirect()->route('mous.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $MOU = MOU::findOrFail($id);
        $activities1 = Activity::Where('mou_id', $id)->where('round', 1)->get();
        $activities2 = Activity::Where('mou_id', $id)->where('round', 2)->get();
        // $activity2 = Activity::findOrFail($id)->where('round', 2);

        return view('mou.show', compact('MOU', 'activities1', 'activities2'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $MOU = MOU::findOrFail($id);
        $departments = Department::pluck('dep_name', 'dep_id');
        $countries = Country::pluck('ct_nameENG', 'ct_code');
        return view('mou.edit', compact('MOU', 'departments', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $MOU = MOU::findOrFail($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name =time().$file->getClientOriginalName();
            $fileToDelete = public_path('uploads/' . $MOU->file_path);
            unlink($fileToDelete);
            $file->move('uploads', $file_name);
        }
        $file_name = $MOU->file_path;

        $MOU->update(
            [
                'mou_no' => $request->input('mou_no'),
                'mou_year' => $request->input('mou_year'),
                'subject' => $request->input('subject'),
                'ext_department' => $request->input('ext_department'),
                'dep_id' => $request->input('dep_id'),
                'country' => $request->input('ct_code'),
                'status' => $request->input('status'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'mou_type' => $request->input('mou_type'),
                'file_path' => $file_name,
            ]
        );

        session()->flash('success', 'MOU updated successfully.');

        return redirect()->route('mous.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MOU $mOU)
    {
        //
    }

    public function export() {
        // ดึงข้อมูลจากฐานข้อมูล
        $mous = MOU::all();

        // กำหนดชื่อไฟล์ CSV ที่จะส่งออก
        $csvFileName = 'mous.csv';

        // เปิดไฟล์ CSV สำหรับเขียนข้อมูล
        $handle = fopen($csvFileName, 'w');
        fputcsv($handle, ['MOU No.', 'MOU Year', 'Subject', 'Vendor', 'dep_id', 'country', 'start date', 'end date', 'file path', 'mou_type', 'status']);

        foreach ($mous as $mou) {
            // แปลงข้อมูลเป็น TIS-620
            $line = array_map('iconv', array_fill(0, count([$mou->mou_no, $mou->mou_year, $mou->subject, $mou->ext_department, $mou->dep_id, $mou->country, $mou->start_date, $mou->end_date, $mou->file_path, $mou->mou_type, $mou->status]), 'UTF-8'), array_fill(0, count([$mou->mou_no, $mou->mou_year, $mou->subject, $mou->ext_department, $mou->dep_id, $mou->country, $mou->start_date, $mou->end_date, $mou->file_path, $mou->mou_type, $mou->status]), 'TIS-620'), [$mou->mou_no, $mou->mou_year, $mou->subject, $mou->ext_department, $mou->dep_id, $mou->country, $mou->start_date, $mou->end_date, $mou->file_path, $mou->mou_type, $mou->status]);
            fputcsv($handle, $line);
        }

        // ปิดไฟล์ CSV
        fclose($handle);

        // ส่งคืนไฟล์ CSV สำหรับดาวน์โหลด
        return response()->download($csvFileName)->deleteFileAfterSend(true);

        // return Response::make('', 200, $headers);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = fopen($file->getRealPath(), 'r');

        while (($line = fgetcsv($fileContents, 1000, ',')) !== false) {
            // แปลงข้อมูลจาก TIS-620 เป็น UTF-8
            $line = array_map('iconv', array_fill(0, count($line), 'TIS-620'), array_fill(0, count($line), 'UTF-8'), $line);

            // สร้างและบันทึกข้อมูล
            MOU::create([
                'mou_no' => $line[0],
                'mou_year' => $line[1],
                'subject' => $line[2],
                'ext_department' => $line[3],
                'dep_id' => $line[4],
                'country' => $line[5],
                'start_date' => $line[6],
                'end_date' => $line[7],
                'file_path' => $line[8],
                'mou_type' => $line[9],
                'status' => $line[10],
            ]);
        }

        fclose($fileContents);

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
}
