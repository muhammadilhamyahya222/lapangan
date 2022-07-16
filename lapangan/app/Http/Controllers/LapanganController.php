<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Lapangan;
use Auth;
class LapanganController extends Controller
{

  function __construct()
  {

  }

  public function get()
  {
    $lapangan = [];
    foreach (Lapangan::all() as $l) {
      $item = [
        "id" => $l->id,
        "nama" => $l->nama,
        "harga" => $l->harga,
        "gambar" => $l->gambar
      ];
      array_push($lapangan,$item);
    }
    return response(["lapangan" => $lapangan]);
  }

  public function find(Request $request)
  {
    $find = $request->find;
    $lapangan = [];
    foreach (Lapangan::where("nama","like","%$find%")->orwhere("harga", "like", "%$find%")->get() as $l) {
      $item = [
        "id" => $l->id,
        "nama" => $l->nama,
        "harga" => $l->harga,
        "gambar" => $l->gambar,
      ];
      array_push($lapangan,$item);
    }
    return response(["lapangan" => $lapangan]);
  }

  public function save(Request $request)
  {
    $action = $request->action;
    if ($action == "insert") {
      try {

        $lapangan = new Lapangan();
        $lapangan->nama = $request->nama;
        $lapangan->harga = $request->harga;
        
        if($request->file('gambar')){
          $file = $request->file('gambar');
          $nama = $file->getClientOriginalname();
          $file->move(\base_path() ."/public/images", $nama);
          $lapangan->gambar = $nama;
        }
        $lapangan->save();
      
        return response(["message" => "Data Lapangan berhasil ditambahkan"]);
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
    }else if($action == "update"){
      try {
        
        $lapangan = Lapangan::where("id", $request->id)->first();
        $lapangan->nama = $request->nama;
        $lapangan->harga = $request->harga;
        
        if($request->file('gambar')){
          $file = $request->file('gambar');
          $nama = $file->getClientOriginalname();
          $file->move(\base_path() ."/public/images", $nama);
          $lapangan->gambar = $nama;
        }
        $lapangan->save();

        return response(["message" => "Data Lapangan berhasil diubah"]);
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
    }
  }

  public function drop($id)
  {
    try {
      Lapangan::where("id", $id)->delete();
      return response(["message" => "Data Lapangan berhasil dihapus"]);
    } catch (\Exception $e) {
      return response(["message" => $e->getMessage()]);
    }
  }

}
 ?>
