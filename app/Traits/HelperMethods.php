<?php

namespace App\Traits;

use Auth;

trait HelperMethods
{
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function sanitize($data, $filters = [])
    {
        $sanitizer  = new \Waavi\Sanitizer\Sanitizer($data, $filters);

        return $sanitizer->sanitize();
    }

    public function awsAssetsUrl($file_path)
    {
        $source_url = env('APP_WEB_ASSETS_URL') ?? env('AWS_S3_URL');
        
        return $source_url.$file_path;
    }

    public function creator()
    {
        $creation_event = $this->audits()->where(['event' => 'created'])->first();
        if (!empty($creation_event)) {
            return $creation_event->user;
        }
    }

    public function deletable()
    {
        $actor = Auth::user();
        if (empty($actor)) {
            return false;
        }

        $condition = $this->user_id == $actor->id;
        $condition = $condition || $this->creator() == $actor;
        $condition = $condition || $actor->isAdmin();
        
        return $condition;
    }

    public function editable()
    {
        $actor = Auth::user();
        if (empty($actor)) {
            return false;
        }

        $condition = $this->user_id == $actor->id;
        $condition = $condition || $this->creator() == $actor;
        $condition = $condition || $actor->isAdmin();

        return $condition;
    }

    public function originator()
    {
        $audit_event = $this->audits()->latest()->first();
        if (!empty($audit_event)) {
            return $audit_event->user;
        }
    }

    public function getDeletableAttribute()
    {
        return $this->deletable();
    }

    public function getEditableAttribute()
    {
        return $this->editable();
    }
}
