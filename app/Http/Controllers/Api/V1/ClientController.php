<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

use Auth;
use DataTables;
use DB;

use App\Models\Client;
use App\Models\ClientPair;

class ClientController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');

        if (Auth::user()->isAdmin()) {
            if (isset($user_id)) {
                if ($user_id != Auth::user()->id) {
                    $clients = Client::where('user_id', '=', $user_id)->get();
                } else {
                    $clients = Client::where('user_id', '=', Auth::user()->id)->get();
                }
            } else {
                $clients = Client::all();
            }
        } else {
            $clients = Client::where('user_id', '=', Auth::user()->id)->get();
        }

        if (!empty($request->scan_type)) {
            $scan_type = $request->scan_type;

            if ($scan_type == 'body_scan') {
                $client_pairs = DB::table('client_pairs')->join('pairs', function ($join) {
                    $join->on('client_pairs.pair_id', '=', 'pairs.id')->where('pairs.scan_type', '=', 'body_scan');
                })->get();
            } elseif ($scan_type == 'chakra_scan') {
                $client_pairs = DB::table('client_pairs')->join('pairs', function ($join) {
                    $join->on('client_pairs.pair_id', '=', 'pairs.id')->where('pairs.scan_type', '=', 'chakra_scan');
                })->get();
            }

            if (!empty($client_pairs)) {
                $client_ids = collect($client_pairs->pluck('client_id')->toArray())->unique();
                $clients = Client::findOrFail($client_ids);
            }
        }

        return response()->json($clients, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $condition = Auth::user()->isAdmin() || Auth::user()->isPractitioner() || Auth::user()->isTherapist();

        if ($condition) {
            $params = $request->all();
            $params['user_id'] = Auth::user()->id;

            $client = new Client($params);

            if ($client->save()) {
                return response()->json($client, Response::HTTP_CREATED);
            } else {
                return $this->sendInvalidResponse($client->getErrors());
            }
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

        if ($client->user_id == Auth::user()->id || Auth::user()->isAdmin()) {
            return response()->json($client, Response::HTTP_OK);
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        if ($client->user_id == Auth::user()->id || Auth::user()->isAdmin()) {
            $client->update($request->all());

            return response()->json($client, Response::HTTP_OK);
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        if ($client->user_id == Auth::user()->id || Auth::user()->isAdmin()) {
            $client->delete();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\JsonResponse
      */
    public function datatables(Request $request)
    {
        $user_id = $request->input('user_id');

        if (Auth::user()->isAdmin()) {
            if (isset($user_id)) {
                if ($user_id != Auth::user()->id) {
                    $clients = Client::where('user_id', '=', $user_id);
                } else {
                    $clients = Client::where('user_id', '=', Auth::user()->id);
                }
            } else {
                $clients = Client::all();
            }
        } else {
            $clients = Client::where('user_id', '=', Auth::user()->id);
        }

        return DataTables::of($clients)->toJson();
    }
}
