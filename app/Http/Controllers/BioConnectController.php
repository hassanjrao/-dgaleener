<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use DB;
use URL;
use Storage;

use Auth;

use Aws\S3\Exception\S3Exception;
use App\Models\User;

class BioConnectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('subscriber')->except('index', 'groups', 'profile', 'info');
    }

    public function index()
    {
        return view('app.pages.bioconnect.friends');
    }

    public function info()
    {
        return view('app.pages.bioconnect.info');
    }

    public function profile()
    {
        $data['pro_info']= User::find(Auth::user()->id);
        return view('app.pages.bioconnect.profile', $data);
    }

    public function activities()
    {
        return view('app.pages.bioconnect.activities');
    }

    public function friends()
    {
        return view('app.pages.bioconnect.friends');
    }

    public function request()
    {
        return view('app.pages.bioconnect.friends_requests');
    }

    public function findFriend()
    {
        return view('app.pages.bioconnect.findfriends');
    }

    public function groups()
    {
        $data["posts"] = \App\Models\GroupDiscussion::where('dis_status', 1)->orderBy('created_at', 'DESC')->get();
        return view('app.pages.bioconnect.groups', $data);
    }

    public function groups_mydiscussion()
    {
        $data["posts"] = DB::table('group_discussions')->select('discussion')->where('dis_status', 1)->orderBy('created_at', 'DESC')->get();
        return view('app.pages.bioconnect.groups_mydiscussion', $data);
    }

    public function groups_mycomment()
    {
        $data["posts"] = DB::table('group_discussions')->select('discussion')->where('dis_status', 1)->orderBy('created_at', 'DESC')->get();
        return view('app.pages.bioconnect.groups_mycomment', $data);
    }

    public function groups_mostcomments()
    {
        $data["posts"] = DB::table('group_discussions')->select('discussion')->where('dis_status', 1)->orderBy('created_at', 'DESC')->get();
        return view('app.pages.bioconnect.groups_mostcomments', $data);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!empty($request->name)) {
            $user->name = $request->name;
        }
        if (!empty($request->email)) {
            $user->email = $request->email;
        }
        if (!empty($request->business)) {
            $user->business = $request->business;
        }
        if (!empty($request->location)) {
            $user->location = $request->location;
        }
        if (!empty($request->privacy) && $request->privacy == 'on') {
            $user->privacy = true;
        } else {
            $user->privacy = false;
        }

        $user->save();

        return redirect()->to('/bioconnect/profile');
    }

    public function saveprofile_database(Request $request)
    {
        $postdate = $request->all();
        $user_id = $postdate['user_id'];

        if ($request->input('togBtn')) {
            $postdate['privacy'] = 1;
        } else {
            $postdate['privacy'] = 0;
        }

        if (!empty($_FILES['upload']['tmp_name'])) {
            $filename   = $_FILES['upload']['name'];
            $s3_name    = time()."_".$_FILES['upload']['name'];
            $filePath   = '/users/uid-'.$user_id.'/profile_pictures/'.$s3_name;

            try {
                $s3Obj = Storage::disk('s3');
                $s3Obj->put($filePath, fopen($_FILES['upload']['tmp_name'], 'r+'), 'public');
            } catch (S3Exception $e) {
                echo($e);exit;
                return redirect()->to('/bioconnect/profile')->with('message.fail', 'S3 Error in uploading file. Please try again.');
            }

            $postdate['profile_picture'] = $s3_name;
        }

        $user = User::find($user_id);
        $user->update($postdate);

        if (empty($user->getErrors()->all())) {
            return redirect()->to('/bioconnect/profile')->with('message.success', 'You have successfully saved your profile.');
        } else {
            return redirect('/bioconnect/profile')->with('message.fail', 'Unable to save your profile, please check your inputs in the form below.')->withErrors($user->getErrors());
        }
    }
}
