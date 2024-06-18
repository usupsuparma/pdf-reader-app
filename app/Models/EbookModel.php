<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EbookModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'ebooks';

    protected $fillable = [
        'name',
        'path',
        'avatar',
    ];
}
