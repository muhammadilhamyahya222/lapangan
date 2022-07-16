<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $table = "sewa";
    protected $primaryKey = "id";
    protected $fillable = ["id_lapangan", "id_user", "tgl_book", "wkt_mulai","wkt_selesai","durasi","biaya","status"];

    public function user()
    {
      return $this->belongsTo("App\Users", "id_user" ,"id");
    }
    public function lapangan()
    {
      return $this->belongsTo("App\Lapangan", "id_lapangan" ,"id");
    }
}
