<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

use Auth;

use App\Http\Controllers\Api\V1\BaseController;

use App\Models\User\Friend;
use App\Models\User;

class FriendController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($user_id = null)
    {
        $user = Auth::user();
        
        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }

        if ($user->id == Auth::user()->id || Auth::user()->isAdmin()) {
            $friends = $user->friends()->get();

            return response()->json($friends, Response::HTTP_OK);
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function friend_requests($user_id = null)
    {
        $user = Auth::user();
        
        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }
        
        if ($user->id == Auth::user()->id || Auth::user()->isAdmin()) {
            $friends = $user->friendRequests()->get();

            return response()->json($friends, Response::HTTP_OK);
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $user_id = null)
    {
        $user = Auth::user();
        
        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }

        if ($user->id == Auth::user()->id || Auth::user()->isAdmin()) {
            $params = $request->all();
            $params['user_id'] = $user->id;
            $params['accepted'] = false;

            $friend = new Friend($params);

            if ($friend->save()) {
                return response()->json($friend, Response::HTTP_CREATED);
            } else {
                return $this->sendInvalidResponse($friend->getErrors());
            }
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $user_id = $request->user_id;

        $user = Auth::user();

        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }

        $friend = $user->friends()->findOrFail($id);

        return response()->json($friend, Response::HTTP_OK);
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
        $user_id = $request->user_id;

        $user = Auth::user();

        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }

        if ($user->id == Auth::user()->id || Auth::user()->isAdmin()) {
            $params = $request->all();

            $user_friend = $user->friends()->findOrFail($id);

            if ($user_friend->update($params)) {
                return response()->json($user_friend, Response::HTTP_OK);
            } else {
                return $this->sendInvalidResponse($user_friend->getErrors());
            }
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $user_id = $request->user_id;
        
        $user = Auth::user();

        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }

        if ($user->id == Auth::user()->id || Auth::user()->isAdmin()) {
            $user_friend = $user->friends()->findOrFail($id);
            $user_friend->delete();
    
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }
    
    /*
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function accept(Request $request, $id)
    {
        $user_id = $request->user_id;

        $user = Auth::user();

        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }

        if ($user->id == Auth::user()->id || Auth::user()->isAdmin()) {
            $user_friend = $user->friendRequests()->findOrFail($id);
            $user_friend->accepted = true;
            $user_friend->save();

            return response()->json($user_friend, Response::HTTP_OK);
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }

    /**
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function reject(Request $request, $id)
    {
        $user_id = $request->user_id;
        
        $user = Auth::user();

        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }

        if ($user->id == Auth::user()->id || Auth::user()->isAdmin()) {
            $user_friend = $user->friendRequests()->findOrFail($id);
            $user_friend->delete();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } else {
            return $this->sendUnauthorizedResponse();
        }
    }
    
    /**
    * @param  int  $user_id
    * @return \Illuminate\Http\JsonResponse
    */
    public function available($user_id = null)
    {
        $user = Auth::user();

        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
        }
        
        $user_ids = [Auth::user()->id];

        $users = User::whereNotIn('id', array_flatten($user_ids))->get();

        return response()->json($users, Response::HTTP_OK);
    }
}
