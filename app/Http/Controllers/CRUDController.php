<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class CRUDController extends Controller
{
    /**
     * @return string
     */
    protected abstract function getModel();

    /**
     * @return string
     */
    protected abstract function getResponse();

    /**
     * @return string
     */
    protected abstract function getCollection();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ($this->getCollection())(call_user_func([$this->getModel(), 'paginate']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instance = call_user_func([$this->getModel(), 'create'], $request->input());
        return $this->show($instance->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ($this->getResponse())(call_user_func([$this->getModel(), 'findOrFail'], $id));
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
        $instance = call_user_func([$this->getModel(), 'findOrFail'], $id);
        $instance->fill($request->input())->save();
        return $this->show($instance->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instance = call_user_func([$this->getModel(), 'findOrFail'], $id);
        call_user_func([$instance, 'delete']);

        return new Response(status: 202);
    }
}
