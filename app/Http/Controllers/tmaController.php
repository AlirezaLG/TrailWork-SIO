<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TMA;
use App\Helper\MHelper;
use Illuminate\Support\Facades\Session;

class tmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $table = DB::table('t_m_a_s')
        ->join('projects', 'projects.id', '=', 't_m_a_s.project_id')
        ->join('users', 'users.id', '=', 't_m_a_s.user_id')
        ->select('users.name as uname', 'projects.name as pname', 't_m_a_s.*')
        ->orderBy('t_m_a_s.id', 'desc')
        ->get();

        // generate report for weekly 5 days per week
        $weeklyTime = MHelper::weeklyWork($table, 5);
        
        // generate report for weekly 20 days per month 
        $monthlyTime = MHelper::weeklyWork($table, 20);
        

        return view('tma.index', compact('table','weeklyTime','monthlyTime'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = DB::table('projects')->get();
        return view('tma.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate data 
        $request->validate([
            'date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'project_id'=>'required',
        ]);
        
        // current user
        $userId = Auth::id();
        
        
        
        
        // reformat the time for better UX/UI
        $wt_formated = MHelper::formatWorkTime( $request->date,$request->start_time, $request->end_time  );
        
        TMA::create([
            'date'=> $request->date,
            'user_id'=> $userId,
            'date'=> $request->date,
            'start_time'=> $request->start_time,
            'end_time'=> $request->end_time,
            'work_time'=> $wt_formated,
            'project_id'=> $request->project_id,
        ]);

        Session::flash('create', "User Successfully Created");

        return to_route('tma.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $row = TMA::find($id);
        $user = DB::table("users")->where("id", $row->user_id)->first();
        $project = DB::table("projects")->where("id", $row->project_id)->first();
        return view('tma.show',compact('row', 'user', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = TMA::find($id);
        $projects = DB::table('projects')->get();
        return view('tma.edit', compact('row', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        // return $request->all();
        
        // validate the data
        $request->validate([
            'date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'project_id'=>'required',
        ]);
        $row = TMA::find($request->id);
        

        $wt_formated = MHelper::formatWorkTime( $request->date,$request->start_time, $request->end_time  );
        
        // Update it 
        $row->update([
            'date'=> $request->date,
            'start_time'=> $request->start_time,
            'end_time'=> $request->end_time,
            'work_time' => $wt_formated,
            'project_id'=> $request->project_id,
        ]);
        Session::flash('update', "Time log updated successfully");
        return to_route('tma.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = TMA::find($id);
        $row->delete();
        session()->flash('delete','successfully deleted');
        return to_route('tma.index');
    }

    public function export(){
        $fname = 'Time-Management-App.csv';
    
        $header = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fname\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
    
        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($handle, [
                'User ',
                'Project ',
                'Date',
                'Start Time',
                'End Time',
                'Work Time',
            ]);
            
             // Fetch and process data in chunks
             DB::table('t_m_a_s')
            ->join('projects', 'projects.id', '=', 't_m_a_s.project_id')
            ->join('users', 'users.id', '=', 't_m_a_s.user_id')
            ->select('users.name as uname', 'projects.name as pname', 't_m_a_s.*')
            ->orderBy('t_m_a_s.id', 'desc')
            ->chunk(25, function ($tma) use ($handle) {
                foreach ($tma as $row) {
                
                    // Extract data from each row.
                    $data = [
                        isset($row->uname)? $row->uname : '',  
                        isset($row->pname)? $row->pname : '',
                        isset($row->date)? $row->date : '',
                        isset($row->start_time)? $row->start_time : '',
                        isset($row->end_time)? $row->end_time : '',
                        isset($row->work_time)? $row->work_time : '',
                    ];
    
             // Write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });
    
            // Close CSV file handle
            fclose($handle);
        }, 200, $header);
        
    }
}
