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
        if (!is_array($data) || empty($filters)) {
            return $data;
        }

        foreach ($filters as $field => $fieldFilters) {
            if (!array_key_exists($field, $data)) {
                continue;
            }

            $value = $data[$field];
            foreach ((array) $fieldFilters as $filter) {
                $filter = strtolower(trim($filter));

                if (is_null($value)) {
                    continue;
                }

                switch ($filter) {
                    case 'trim':
                        $value = is_string($value) ? trim($value) : $value;
                        break;
                    case 'lower':
                        $value = is_string($value) ? mb_strtolower($value, 'UTF-8') : $value;
                        break;
                    case 'upper':
                        $value = is_string($value) ? mb_strtoupper($value, 'UTF-8') : $value;
                        break;
                    case 'capitalize':
                        $value = is_string($value) ? mb_convert_case($value, MB_CASE_TITLE, 'UTF-8') : $value;
                        break;
                    case 'strip_tags':
                        $value = is_string($value) ? strip_tags($value) : $value;
                        break;
                    case 'escape':
                        $value = is_string($value) ? e($value) : $value;
                        break;
                    case 'int':
                        $value = intval($value);
                        break;
                    case 'float':
                        $value = floatval($value);
                        break;
                    case 'boolean':
                    case 'bool':
                        $value = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                        break;
                    case 'email':
                        $value = is_string($value) ? filter_var($value, FILTER_SANITIZE_EMAIL) : $value;
                        break;
                    case 'url':
                        $value = is_string($value) ? filter_var($value, FILTER_SANITIZE_URL) : $value;
                        break;
                    case 'alpha':
                        $value = is_string($value) ? preg_replace('/[^\p{L}]+/u', '', $value) : $value;
                        break;
                    case 'alnum':
                        $value = is_string($value) ? preg_replace('/[^\p{L}\p{N}]+/u', '', $value) : $value;
                        break;
                    case 'numeric':
                        $value = is_numeric($value) ? $value : preg_replace('/[^0-9\.\-]+/', '', (string) $value);
                        break;
                    default:
                        if (function_exists($filter)) {
                            $value = $filter($value);
                        }
                        break;
                }
            }

            $data[$field] = $value;
        }

        return $data;
    }

    public function awsAssetsUrl($file_path)
    {
        $sourceUrl = env('APP_WEB_ASSETS_URL') ?: env('AWS_S3_URL');
        $normalizedPath = preg_replace('#/+#', '/', '/' . ltrim((string) $file_path, '/'));

        return rtrim((string) $sourceUrl, '/') . $normalizedPath;
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
