<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory,UploadTrait;

    protected $fillable = [
        'attachmentable_id',
        'attachmentable_type',
        'file',
    ];
    public function attachmentable()
    {
        return $this->morphTo();
    }
    public function getFileAttribute() {
        if ($this->attributes['file']) {
            $image = $this->getImage($this->attributes['file'], 'attachments');
        } else {
            $image = $this->defaultImage('attachments');
        }
        return $image;
    }

    public function setFileAttribute($value) {
        if (null != $value && is_file($value)) {
            isset($this->attributes['file']) ? $this->deleteFile($this->attributes['file'], 'attachments') : '';
            $this->attributes['file'] = $this->uploadAllTyps($value, 'attachments');
        }
    }
    public static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
            $model->deleteFile($model->attributes['file'], 'attachments');
        });
    }
}
