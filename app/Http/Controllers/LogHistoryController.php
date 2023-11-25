<?php

namespace App\Http\Controllers;

use App\Models\LogHistory;
use App\Http\Requests\StoreLogHistoryRequest;
use App\Http\Requests\UpdateLogHistoryRequest;

class LogHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function deleteAllLogs()
    {

        $logs = LogHistory::get();

        foreach ($logs as $log) {
            $log->delete();
        }

        return redirect()->back()->with("message", "All Logs successfully deleted !");
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LogHistory $logHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogHistory $logHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogHistoryRequest $request, LogHistory $logHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogHistory $logHistory)
    {
        //
    }
}
