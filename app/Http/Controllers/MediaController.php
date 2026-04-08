<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Auth;
use DB;
use Storage;
use App\Models\Media;
use App\Models\Playlist;
use App\Models\MediaPlaylist;
use DataTables;
use Carbon\Carbon;
use Aws\S3\Exception\S3Exception;

class MediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('subscriber');
    }

    public function index()
    {
        $playlists = Playlist::all()->toArray();
        return view('app.pages.media.index', compact('playlists'));
    }

    public function show($id)
    {
        return Media::find($id);
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);
        $media->update($request->all());
        return redirect()->to('/media')->with('message.success', 'You have successfully updated media details.');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();
        return redirect()->to('/media')->with('message.success', 'You have successfully deleted media file.');
    }

    public function datatables()
    {
        $medias = Media::query();

        return DataTables::eloquent($medias)
            ->addColumn('action', function ($media) {
                if (Auth::user()->isPractitioner()) {
                    if (Auth::user()->id == $media->user_id) {
                        return "
                            <a data-target='#playerModal' data-toggle='modal' href='javascript:void(0)' class='fa fa-headphones fa-2x' onClick='playFile(\"".$media->file_name."\",\"".$media->s3_name."\")' title='Play Media'></a>&nbsp;&nbsp;
                            <a data-target='#comsModal' data-toggle='modal' href='javascript:void(0)' class='fa fa-music fa-2x' onClick='addToPlaylist(".$media->id.", \"".$media->file_name."\", \"media\")' title='Add to Playlist'></a>&nbsp;&nbsp;
                            <a data-target='#editModal' data-toggle='modal' href='javascript:void(0)' class='fa fa-edit fa-2x' onClick='editMedia(".$media->id.", \"".$media->file_name."\", \"".$media->description."\")' title='Edit Media'></a>&nbsp;&nbsp;
                            <a data-target='#deleteModal' data-toggle='modal' href='javascript:void(0)' class='fa fa-trash-o fa-2x' onClick='deleteMedia(".$media->id.")' title='Remove Media'></a>
                        ";
                    } else {
                        return "
                            <a data-target='#playerModal' data-toggle='modal' href='javascript:void(0)' class='fa fa-headphones fa-2x' onClick='playFile(\"".$media->file_name."\",\"".$media->file_url."\")' title='Play Media'></a>&nbsp;&nbsp;
                            <a data-target='#comsModal' data-toggle='modal' href='javascript:void(0)' class='fa fa-music fa-2x' onClick='addToPlaylist(".$media->id.", \"".$media->file_name."\", \"media\")' title='Add to Playlist'></a>
                        ";
                    }
                } else {
                    return "
                        <a data-target='#playerModal' data-toggle='modal' href='javascript:void(0)' class='fa fa-headphones fa-2x' onClick='playFile(\"".$media->file_name."\",\"".$media->file_url."\")' title='Play Media'></a>
                    ";
                }
            })->toJson();
    }

    public function allmedia()
    {
        $mediaArr = array();
        $medialist = Media::inRandomOrder()->get();

        if (count($medialist) > 0) {
            foreach ($medialist as $media) {
                $mediaArr[] = array(
                    'title' => $media->file_name,
                    'mp3'   => $media->file_url
                );
            }
        }
        
        echo json_encode($mediaArr);
    }

    public function store()
    {
        if (!empty($_FILES['media_file']['tmp_name'])) {
            $filename   = $_FILES['media_file']['name'];
            $s3_name    = time()."_".$_FILES['media_file']['name'];
            $filePath   = '/audio_files/'.$s3_name;

            try {
                $s3Obj = Storage::disk('s3');
                $s3Obj->put($filePath, fopen($_FILES['media_file']['tmp_name'], 'r+'), 'public');
            } catch (S3Exception $e) {
                print_r($e);
                return redirect()->to('/media')->with('message.fail', 'S3 Error in uploading file. Please try again.');
            }
            
            $media = Media::create([
                'file_name'     => $filename,
                's3_name'       => $s3_name,
                'description'   => $_POST['description'],
                'user_id'       => Auth::user()->id
            ]);
            return redirect()->to('/media')->with('message.success', 'You have successfully uploaded a media file. See list below for your data.');
        } else {
            return redirect()->to('/media')->with('message.fail', 'Error in uploading file. Please try again.');
        }
    }
}
