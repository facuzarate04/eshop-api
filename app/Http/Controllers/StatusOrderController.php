<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusOrderRequest;
use App\Http\Requests\UpdateStatusOrderRequest;
use App\Models\StatusOrder;

class StatusOrderController extends Controller
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
     * @param  \App\Http\Requests\StoreStatusOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function show(StatusOrder $statusOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusOrder $statusOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatusOrderRequest  $request
     * @param  \App\Models\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatusOrderRequest $request, StatusOrder $statusOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusOrder $statusOrder)
    {
        //
    }
}
