<?php

namespace App\Http\Controllers;

use App\Models\BroadcastRecipient;
use App\Http\Requests\StoreBroadcastRecipientRequest;
use App\Http\Requests\UpdateBroadcastRecipientRequest;

class BroadcastRecipientController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBroadcastRecipientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBroadcastRecipientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BroadcastRecipient  $broadcastRecipient
     * @return \Illuminate\Http\Response
     */
    public function show(BroadcastRecipient $broadcastRecipient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BroadcastRecipient  $broadcastRecipient
     * @return \Illuminate\Http\Response
     */
    public function edit(BroadcastRecipient $broadcastRecipient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBroadcastRecipientRequest  $request
     * @param  \App\Models\BroadcastRecipient  $broadcastRecipient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBroadcastRecipientRequest $request, BroadcastRecipient $broadcastRecipient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BroadcastRecipient  $broadcastRecipient
     * @return \Illuminate\Http\Response
     */
    public function destroy(BroadcastRecipient $broadcastRecipient)
    {
        //
    }
}
