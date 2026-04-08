<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

use Auth;

use App\Models\ScanSessionPair;

class ScanSessionPairController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $scan_type = $request->input('scan_type');
        $name = $request->input('name');

        $scan_session_pairs = ScanSessionPair::join('pairs', 'scan_session_pairs.pair_id', '=', 'pairs.id');

        if ($scan_type != '') {
            $scan_session_pairs = $scan_session_pairs->where('pairs.scan_type', '=', $scan_type);
        }

        if ($name != '') {
            $scan_session_pairs = $scan_session_pairs->where('pairs.name', 'like', '%'.$name.'%');
        }

        $scan_session_pairs = $scan_session_pairs->orderBy('pairs.name', 'asc')->get();

        return response()->json($scan_session_pairs, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $scan_session_pair = ScanSessionPair::findOrFail($id);

        return response()->json($scan_session_pair, Response::HTTP_OK);
    }
}
