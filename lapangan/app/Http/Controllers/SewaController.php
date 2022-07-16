<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sewa;
use App\Users;
use App\Profil;
use App\Lapangan;
use Auth;
class SewaController extends Controller
{

  function __construct()
  {

  }

  public function get()
  {
    $sewa = [];
    foreach (Sewa::latest('id')->get() as $s) {
      $item = [
        "id_sewa" => $s->id,
        "id_lapangan" => $s->id_lapangan,
        "nama_lapangan" => $s->lapangan->nama,
        "id_user" => $s->id_user,
        "username" => $s->user->username,
        "tgl_book" => $s->tgl_book,
        "wkt_mulai" => $s->wkt_mulai,
        "wkt_selesai" => $s->wkt_selesai,
        "durasi" => $s->durasi,
        "biaya" => $s->biaya,
        "status" => $s->status,
      ];
       array_push($sewa,$item);
    }
    return response(["sewa" => $sewa]);
  }

  public function find(Request $request)
  {
    $tgl = $request->tgl;
    $sewa = [];
    foreach (Sewa::where('tgl_book',"like","%$tgl%")->get() as $s) {
      $item = [
        "id_sewa" => $s->id,
        "id_lapangan" => $s->id_lapangan,
        "nama_lapangan" => $s->lapangan->nama,
        "id_user" => $s->id_user,
        "username" => $s->user->username,
        "tgl_book" => $s->tgl_book,
        "wkt_mulai" => $s->wkt_mulai,
        "wkt_selesai" => $s->wkt_selesai,
        "durasi" => $s->durasi,
        "biaya" => $s->biaya,
        "status" => $s->status,
      ];
       array_push($sewa,$item);
    }
    return response(["sewa" => $sewa]);
  }

  public function save(Request $request)
  {
    $action = $request->action;
    if ($action == "insert") {
      try {
        $last = Sewa::where('id_lapangan',"$request->id_lapangan")->where('tgl_book',"$request->tgl_book")->orwhere('wkt_mulai',"$request->wkt_mulai")->orwhere('wkt_selesai',"$request->wkt_selesai")->count();
        if ($last == 0) {
          $sewa = new Sewa();
          $sewa->id_lapangan = $request->id_lapangan;
          $sewa->id_user = $request->id_user;
          $sewa->tgl_book = $request->tgl_book;
          $sewa->wkt_mulai = $request->wkt_mulai;
          $sewa->wkt_selesai = $request->wkt_selesai;
          
          $start = strtotime($request->wkt_mulai);
          $end = strtotime($request->wkt_selesai);
          $durasi = floor(($end - $start)/(60*60));

          $lap = Lapangan::where('id', $request->id_lapangan)->first();
          $biaya = $lap->harga * $durasi;

          $sewa->durasi = $durasi;
          $sewa->biaya = $biaya;
          $sewa->status = "booked";
          $sewa->save();
          return response(["message" => "Lapangan berhasil dibooking"]);
        }
        else {
          return response(["message" => "Lapangan telah dibooking member lain"]);
        }
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
    }else if($action == "update"){
      try {
        $sewa = Sewa::where("id", $request->id)->first();
        $sewa->id_lapangan = $request->id_lapangan;
        $sewa->id_user = $request->id_user;
        $sewa->tgl_book = $request->tgl_book;
        $sewa->wkt_mulai = $request->wkt_mulai;
        $sewa->wkt_selesai = $request->wkt_selesai;
        
        $start = strtotime($request->wkt_mulai);
        $end = strtotime($request->wkt_selesai);
        $durasi = floor(($end - $start)/(60*60));

        $lap = Lapangan::where('id', $request->id_lapangan)->first();
        $biaya = $lap->harga * $durasi;

        $sewa->durasi = $durasi;
        $sewa->biaya = $biaya;
        $sewa->status = "booked";
        $sewa->save();
        return response(["message" => "Data sewa berhasil diubah"]);
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
    }
  }

  public function drop($id)
  {
    try {
      Sewa::where("id", $id)->delete();
      return response(["message" => "Data Sewa berhasil dihapus"]);
    } catch (\Exception $e) {
      return response(["message" => $e->getMessage()]);
    }
  }

  public function used($id)
  {
    try {
      $s = Sewa::where("id", $id)->first();
      $s->status = "used";
      $s->save();
      return response(["message" => "Lapangan berhasil digunakan"]);
    } catch (\Exception $e) {
      return response(["message" => $e->getMessage()]);
    }
  }

  public function done($id)
  {
    try {
      $s = Sewa::where("id", $id)->first();
      $s->status = "done";
      $s->save();
      return response(["message" => "Lapangan selesai digunakan"]);
    } catch (\Exception $e) {
      return response(["message" => $e->getMessage()]);
    }
  }

  public function myOrder($id)
  {
    $sewa = [];
    foreach (Sewa::latest('id', $id)->get() as $s) {
      $item = [
        "id_sewa" => $s->id,
        "id_lapangan" => $s->id_lapangan,
        "nama_lapangan" => $s->lapangan->nama,
        "id_user" => $s->id_user,
        "username" => $s->user->username,
        "tgl_book" => $s->tgl_book,
        "wkt_mulai" => $s->wkt_mulai,
        "wkt_selesai" => $s->wkt_selesai,
        "durasi" => $s->durasi,
        "biaya" => $s->biaya,
        "status" => $s->status,
      ];
       array_push($sewa,$item);
    }
    return response(["sewa" => $sewa]);
  }

}
 ?>
