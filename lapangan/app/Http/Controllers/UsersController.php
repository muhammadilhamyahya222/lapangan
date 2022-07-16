<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Users;
use App\Profil;
use Auth;
class UsersController extends Controller
{

  function __construct()
  {

  }

  public function register(Request $request)
  {
    try {
        $users = new Users();
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = Crypt::encrypt($request->password);
        $users->role = "member";
        $users->save();

        $u = Users::where("email", $request->email)->first();
        $profil = new Profil();
        $profil->id_user = $u->id;
        $profil->save();
        
        return response(["message" => "Register berhasil"]);
    } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
    }
  }

  public function login(Request $request)
  {
    $username = $request->username;
    $password = $request->password;    

    $users = Users::where("username", $username)->orwhere("email", $username);
    if ($users->count() > 0) {
      // login sukses
      $u = $users->first();
      if(Crypt::decrypt($u->password) == $password){
        return response(["status" => true, "users" => $u, "role" => $u->role, "token" => Crypt::encrypt($u->id)]);
      }else{
        return response(["status" => false]);
      }
    }else{
      return response(["status" => false]);
    }
  }

  //Admin
  public function get()
  {
    $users = [];
    foreach (Profil::all() as $u) {
      $item = [
        "id" => $u->user->id,
        "username" => $u->user->username,
        "email" => $u->user->email,
        "password" => Crypt::decrypt($u->user->password),
        "role" => $u->user->role,
        "first_name" => $u->first_name,
        "last_name" => $u->last_name,
        "gender" => $u->gender,
        "date_birth" => $u->date_birth,
        "image" => $u->image,
      ];
      array_push($users, $item);
    }
    return response([
      "member" => $users
    ]);
  }

  public function find(Request $request)
  {
    $searchBy = $request->searchBy;
    $find = $request->find;
    $users = [];
    foreach (Profil::where($searchBy,"like","%$find%")->get() as $u) {
      $item = [
        "id" => $u->user->id,
        "username" => $u->user->username,
        "email" => $u->user->email,
        "password" => Crypt::decrypt($u->user->password),
        "role" => $u->user->role,
        "first_name" => $u->first_name,
        "last_name" => $u->last_name,
        "gender" => $u->gender,
        "date_birth" => $u->date_birth,
        "image" => $u->image,
      ];
      array_push($users, $item);
    }
    return response([
      "member" => $users
    ]);
  }

  public function save(Request $request)
  {
    $action = $request->action;
    if ($action == "insert") {
      try {
        $users = new Users();
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = Crypt::encrypt($request->password);
        $users->role = $request->role;
        $users->save();

        $u = Users::where("email", $request->email)->first();
        $profil = new Profil();
        $profil->id_user = $u->id;
        $profil->first_name = $request->first_name;
        $profil->last_name = $request->last_name;
        $profil->gender = $request->gender;
        $profil->date_birth = $request->date_birth;
        $profil->no_hp = $request->no_hp;
        $profil->alamat = $request->alamat;
        $profil->save();
        
        return response(["message" => "Data user berhasil ditambahkan"]);
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
    }else if($action == "update"){
      try {
        $users = Users::where("id", $request->id)->first();
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = Crypt::encrypt($request->password);
        $users->role = $request->role;
        $users->save();

        $profil = Profil::where("id_user", $request->id)->first();
        $profil->first_name = $request->first_name;
        $profil->last_name = $request->last_name;
        $profil->gender = $request->gender;
        $profil->date_birth = $request->date_birth;
        $profil->no_hp = $request->no_hp;
        $profil->alamat = $request->alamat;
        $profil->save();
        return response(["message" => "Data user berhasil diubah"]);
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
    }
  }

  public function drop($id)
  {
    try {
      Users::where("id", $id)->delete();
      return response(["message" => "Data user berhasil dihapus"]);
    } catch (\Exception $e) {
      return response(["message" => $e->getMessage()]);
    }
  }

  //User
  public function myProfil($id)
  {
    $users = [];
    $p = Profil::where('id_user', $id)->first();
    $u = Users::where('id', $id)->first();
      $item = [
        "id" => $u->id,
        "username" => $u->username,
        "email" => $u->email,
        "password" => Crypt::decrypt($u->password),
        "role" => $u->role,
        "first_name" => $p->first_name,
        "last_name" => $p->last_name,
        "gender" => $p->gender,
        "date_birth" => $p->date_birth,
        "image" => $p->image,
      ];
      array_push($users, $item);
    return response([
      "profil" => $users
    ]);
  }

  public function saveProfil(Request $request)
  {
      try {
        $users = Users::where("id", $request->id)->first();
        $users->username = $request->username;
        $users->email = $request->email;        
        $users->save();

        $profil = Profil::where("id_user", $request->id)->first();
        $profil->first_name = $request->first_name;
        $profil->last_name = $request->last_name;
        $profil->gender = $request->gender;
        $profil->date_birth = $request->date_birth;
        $profil->no_hp = $request->no_hp;
        $profil->alamat = $request->alamat;
        $profil->save();
        return response(["message" => "Data profil berhasil diubah"]);
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
  }

  public function savePwd(Request $request)
  {
      try {
        $users = Users::where("id", $request->id)->first();
        $lastPwd = $request->last_password;
        if ($users->password == $lastPwd){
          $users->password = Crypt::encrypt($request->new_password);     
          $users->save();
          return response(["message" => "Data password berhasil diubah"]);
        }
        else {
          return response(["message" => "Password lama salah"]);
        }
      } catch (\Exception $e) {
        return response(["message" => $e->getMessage()]);
      }
  }
  
}
 ?>
