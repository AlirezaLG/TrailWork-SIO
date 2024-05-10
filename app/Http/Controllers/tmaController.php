<?php

namespace App\Http\Controllers;

use App\Repositories\TmaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tma;
use App\Helper\MHelper;

class TmaController extends Controller
{
    private TmaRepositoryInterface $tmaRepository;

    public function __construct(TmaRepositoryInterface $tmaRepository)
    {
        $this->tmaRepository = $tmaRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = $this->tmaRepository->getAll();
        $weeklyTime = MHelper::totalWork($rows, 5);
        $monthlyTime = MHelper::totalWork($rows, 20);
        return view('tma.index', compact('rows', 'weeklyTime', 'monthlyTime'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = $this->tmaRepository->create();
        return view('tma.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data 
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'project_id' => 'required|integer',
        ]);

        // Reformat the time for better UX/UI
        $wtFormatted = MHelper::reShapeWorkTime($request->date, $request->start_time, $request->end_time);

        $data = array(
            'date' => $request->date,
            'user_id' => Auth::id(),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'work_time' => $wtFormatted,
            'project_id' => $request->project_id,
        );

        $this->tmaRepository->storeDetail($data);
        return redirect()->route('tma.index')->with('create', 'User Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $row = $this->tmaRepository->getById($id);
        return view('tma.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        [$row, $projects] = $this->tmaRepository->edit($id);
        return view('tma.edit', compact('row', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'project_id' => 'required|integer',
        ]);

        $wtFormatted = MHelper::reShapeWorkTime($request->date, $request->start_time, $request->end_time);
        $data = array(
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'work_time' => $wtFormatted,
            'project_id' => $request->project_id,
        );

        $this->tmaRepository->update($id, $data);

        return redirect()->route('tma.index')->with('update', 'Time log updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->tmaRepository->delete($id);
        return redirect()->route('tma.index')->with('delete', 'successfully deleted');
    }

    /**
     * Export the specified resource.
     */
    public function export()
    {
        $fileName = 'Time-Management-App.csv';
        $header = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'User',
                'Project',
                'Date',
                'Start Time',
                'End Time',
                'Work Time',
            ]);

            // Fetch and process data in chunks

            Tma::with(['user', 'project'])->latest()->chunk(25, function ($tma) use ($handle) {
                foreach ($tma as $row) {
                    // Extract data from each row.
                    $data = [
                        $row->user->name ?? '',
                        $row->project->name ?? '',
                        $row->date ?? '',
                        $row->start_time ?? '',
                        $row->end_time ?? '',
                        $row->work_time ?? '',
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
