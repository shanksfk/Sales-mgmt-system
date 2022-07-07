<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\User;

class UserController extends Controller
{
    function login(Request $req)
    {
        $user = User::where(['email' => $req->email])->where(['password' => $req->password])->first();
    

    if (!$user){
        return "Email not found ";
    }
    else  {
        $req->session()->put('user', $user);
        return redirect('/login');
    }
    }

    function register(Request $req){
        
        DB::insert('INSERT INTO users
    (name, email, password, mobilephone, address1, postcode, created_at) VALUES (?,?,?,?,?,?,?)',[$req->name,$req->email, $req->password, $req-> mobilephone, $req->address1, $req->postcode, now()]);

    return redirect('/?success=true');

    }
    function getuser(Request $req){
        $data=DB::table('users')
        ->where('id',$req->rid)
        ->first();

        return view('edituser',['user'=>$data]);
    }
    
    function edituser(Request $req)
    {
        DB::table('users')->where('id', $req->rid)->update(array('name'=>$req->name, 
        'password'=>$req->password, 'email'=>$req->email, 
        'updated_at'=>DB::raw('now()')
    ));
        return redirect('/login');
    }

    function listuser()
    {
        return view('listuser',
        ['listofuser'=>
        DB::table('users')->paginate(5)]);
    }

    function search(Request $req)
    {
        return view('listuser',['listofuser'=>
        DB::table('users')
        ->select(DB::raw('id, name, email, password, created_at, updated_at'))
        ->where('email','like', '%'.$req->search.'%')
        ->orwhere('name','like', '%'.$req->search.'%')
        ->orderBy('name','ASC')->paginate(5)]);
    }

    function deleteuser(Request $req)
    {   
        $user=User::where(['id' => $req->rid])->first();
        $email=DB::table('users')
        ->select(DB::raw('email'))
        ->where('id',$req->rid)
        ->first();

        DB::table('users')->where('id', $req->rid)->delete();
        //return "succesfully deleted";
        $deleted=true;
        return redirect('/userlist?deleted=1&user'.$user);
    }
}