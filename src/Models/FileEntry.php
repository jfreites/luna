<?php

namespace Jfreites\Luna\Models;

use Illuminate\Database\Eloquent\Model;

class FileEntry extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'file_entries';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['filename', 'original_filename', 'path', 'mime'];
}
