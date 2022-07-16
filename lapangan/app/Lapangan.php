<?php

namespace App;
use App\Category;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $table = "lapangan";
    protected $primaryKey = "id";
    protected $fillable = ["nama","harga","gambar"];
}
