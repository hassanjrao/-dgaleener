<?php

namespace App\Models;

use Watson\Validating\ValidatingTrait;

class Media extends Base
{
    use ValidatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_name', 's3_name', 'description', 'user_id'
    ];

    protected $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'file_name' => 'required|string',
        's3_name' => 'required|string|unique:media,s3_name',
        'description' => 'nullable|string'
    ];

    public static function rules($id = null)
    {
        return (new static)->rules;
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($media) {
            $partial_url = 'audio_files/'.$media->s3_name;
            if (\Storage::disk('s3')->exists($partial_url)) {
                \Storage::disk('s3')->delete('/'.$partial_url);
            }

            foreach ($media->mediaPlaylists()->get() as $mediaPlaylist) {
                $mediaPlaylist->delete();
            }
        });
    }

    public function file_url()
    {
        return $this->awsAssetsUrl('/audio_files/'.$this->s3_name);
    }

    public function mediaPlaylists()
    {
        return $this->hasMany(MediaPlaylist::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'media_playlists');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        return $this->file_url();
    }
}
