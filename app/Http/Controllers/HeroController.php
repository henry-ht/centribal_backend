<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Validator;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $credentials = $request->only([
            'search',
            'total',
            'order_by',
        ]);

        $validation = Validator::make($credentials,[
            'search'        => 'sometimes|required|min:2|max:150',
            'total'         => 'sometimes|required|integer',
            'order_by'      => 'sometimes|required|in:ASC,DESC',
        ]);

        if (!$validation->fails()) {

            $response  = Hero::query();

            if (isset($credentials['search'])) {
                $search = '%'.$credentials['search'].'%';
                $response
                ->where('name', 'LIKE', $search);
            }

            if (isset($credentials['order_by'])) {
                $response->orderBy('name', $credentials['order_by']);
            }

            if (isset($credentials['total'])) {
                $response = $response->paginate($credentials['total']);
            }else{
                $response = $response->get();
            }

            $message    = ['message' => [__('List'), ]];
            $status     = 'success';
            $data       = $response;

        }else{
            $message    = $validation->messages();
            $status     = 'warning';
            $data       = false;

        }

        return response([
            'data'          => $data,
            'status'        => $status,
            'message'       => $message
        ],200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hero  $Hero
     * @return \Illuminate\Http\Response
     */
    public function show(Hero $Hero)
    {

        $message    = ['message' => [__('hero'), ]];
        $status     = 'success';
        $data       = $Hero;

        return response([
            'data'          => $data,
            'status'        => $status,
            'message'       => $message
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hero  $Hero
     * @return \Illuminate\Http\Response
     */
    public function edit(Hero $Hero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hero  $Hero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hero $Hero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hero  $Hero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hero $Hero)
    {
        //
    }
}
