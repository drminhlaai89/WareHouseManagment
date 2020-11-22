<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;



class AccountController extends Controller
{
    
    public function userIndex(){
        $importdashboards =  DB::table ('import')
        ->join('supplier','supplier.supplierid','=','import.importsupplier_id')
        ->join('detailimport','detailimport.detailimportimport_id','=','import.importid')
        ->orderBy('import.importcreateddate', 'desc')
        ->take(5)
        ->get();
        $exportdashboards =  DB::table ('export')
        ->join('customer','customer.customerid','=','export.exportcustomer_id')
        ->join('detailexport','detailexport.detailexportexport_id','=','export.exportid')
        ->orderBy('export.exportcreateddate', 'desc')
        ->take(5)
        ->get();
        return view("dashboard")->with([
            'importdashboards' => $importdashboards,
            'exportdashboards' => $exportdashboards
        ]);

    }
    public function index(){
        $totalemp = DB::table('account')->count('id');
        $totalpro = DB::table('product')->count('productid');
        $totalimp = DB::table('detailimport')
        ->join('import',function($join){
            $join->on('import.importid','=','detailimport.detailimportimport_id')
            ->where('import.importtype',0);
        })->sum('detailimportamount');
        
        $totalexp = DB::table('detailexport')
        ->join('export',function($join){
            $join->on('export.exportid','=','detailexport.detailexportexport_id')
            ->where('export.exporttype',0);
        })->sum('detailexportamount');
        $datesimport = DB::table('detailimport')->distinct()->select('detailimportcreateddate')->get();
        $valuesimport = array();
        $datimport=array();
        foreach($datesimport as $key=> $dates){
            $value = DB::table('detailimport')->select('detailimportamount')->where('detailimportcreateddate',$dates->detailimportcreateddate)
            ->sum('detailimportamount');
            array_push($valuesimport,$value);
            array_push($datimport,$dates->detailimportcreateddate);
        }
        $datesexport = DB::table('detailexport')->distinct()->select('detailexportcreateddate')->get();
        $valuesexport = array();
        $datexport=array();
        foreach($datesexport as $key=> $dates){
            $value = DB::table('detailexport')->where('detailexportcreateddate',$dates->detailexportcreateddate)
            ->sum('detailexportamount');
            array_push($valuesexport,$value);
            array_push($datexport,$dates->detailexportcreateddate);
        }
        
        return view('admin.dashboard')->with([
            'totalemp'=>$totalemp,
            'totalpro'=>$totalpro,
            'totalimp' => $totalimp,
            'totalexp' => $totalexp,
            'dateimport'=>$datimport,
            'valueimport'=>$valuesimport,
            'valueexport'=>$valuesexport
        ]);
    }
    public function login(){
        return view('pages.user-pages.login');
    }
    public function checkLogin(Request $request){
        $username =$request->input('txtUser');
        $pass = $request->input('txtPass');
        $user = DB::table('account')->where('username',$username)->first();

        if($user != null && $user->password ==$pass){
            Session() -> put('user',$user);
            if($user->role ==1){  
                return redirect()->action('AccountController@index');
            }else{
                return redirect()->action('AccountController@userIndex');
            }
        }else{
            return redirect()->action('AccountController@login');
        }
        
    }
    public function logout(){
        Session::forget('user');
        return redirect()->action('AccountController@login'); 
    }

    public function listUser(){
        $user = DB::table('account')->get();
        return view('admin.index')->with([
            "user"=>$user
        ]);
    }
    public function create(){
        return view('admin.create');
    }
    public function postCreate(Request $request){
        $username=$request->input('txtUsername');
        $password = $request->input('txtPassword');
        $fullname = $request->input('txtFullname');
        $dob = $request->input('txtDob');
        $image = $request->input('txtImage');
        $address = $request->input('txtAddress');
        $phone = $request->input('txtPhone');
        $role = $request->input('txtRole');
        $status = 1;
        $note = $request->input('txtNote');
        $createddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $createdby = session()->get('user')->username;
        DB::table('account')->insert([
            'username' =>$username,
            'password' =>$password,
            'fullname'=>$fullname,
            'dob'=>$dob,
            'address'=>$address,
            'phone'=>$phone,
            'image'=>$image,
            'role' =>$role,
            'status'=>$status,
            'note'=>$note,
            'createddate'=>$createddate,
            'createdby'=>$createdby
        ]);
        return redirect()->action('AccountController@listUser');
    }
    public function detailUser($id){
        $user = DB::table('account')->where('id',intval($id))->first();
        return view('admin.detail')->with([
            'user'=>$user,
        ]);
    }
    
    public function update($id){
        $user=DB::table('account')->where('id',intval($id))->first();
        return view('admin.update')->with([
            'id'=>$id,
            'user'=>$user
        ]);
    }
    public function postUpdate(Request $request, $id){
        $username=$request->input('txtUsername');
        $password = $request->input('txtPassword');
        $fullname = $request->input('txtFullname');
        $dob = $request->input('txtDob');
        $address = $request->input('txtAddress');
        $phone = $request->input('txtPhone');
        $image = $request->input('txtImage');
        $role = $request->input('txtRole');
        $status = $request->input('txtStatus');
        $note = $request->input('txtNote');
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('account')->where('id',intval($id))->update([
            'username' =>$username,
            'password' =>$password,
            'fullname'=>$fullname,
            'dob'=>$dob,
            'address'=>$address,
            'image'=>$image,
            'phone'=>$phone,
            'role' =>$role,
            'status'=>$status,
            'note'=>$note,
            'modifieddate'=>$modifieddate,
            'modifiedby'=>$modifiedby
        ]);
        
        return redirect()->action('AccountController@listUser');
    }
    public function changePassword($id){
        $user =  DB::table('account')->where('id',intval($id))->first();
        return view('admin.changepassword')->with([
            'id' =>$id,
            'user' =>$user
        ]);
    }
    public function postChangePassword(Request $request,$id){
        $newPass = $request->input('password');
        DB::table('account')->where('id',intval($id))->update([
            'password'=>$newPass
        ]);
        return redirect()->action('AccountController@detailUser',['id'=>$id]); 
    }
    public function resetPassword($id){
        $hashed_random_password = $hashed = Hash::make('password', [
            'rounds' => 8,
        ]);
        $newPassword = substr($hashed_random_password,0,12);

        DB::table('account')->where('id',intval($id))->update([
            'password'=>$newPassword
        ]);
        return redirect()->action('AccountController@detailUser',['id'=>$id]); 
    }
    public function userDetail(){
        $id = session()->get('user')->id;
        $user = DB::table('account')->where('id',intval($id))->first();
        return view('user.detail')->with([
            'user'=>$user,
        ]);
    }

    public function userChangePass(){
        return view('admin.changepassword');
    }
    
    public function  userPostChangePass(Request $request){
        $id = session()->get('user')->id;
        $newPass = $request->input('password');
        DB::table('account')->where('id',intval($id))->update([
            'password'=>$newPass
        ]);
        return redirect()->action('AccountController@userDetail');
    }
    public function searchAccount(Request $request){
        
        if ($request->ajax()) {
            $a = $b = '';
            $output = '';
            $accounts = DB::table('account')
            ->where('username', 'LIKE', '%' . $request->search . '%')
            ->orwhere ('fullname', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($accounts) {
                foreach ($accounts as $key => $account) {
                   $a =  ($account->role == 1 )? 'admin' :'user';
                   if ($account->status == 1){
                    $b =  '<td class="text-success"> Online </td>';
                } else {
                    $b =  '<td class="text-danger"> Offline </td>';
                }
                    $output .= '<tr>
                    <td>' . $account->id . '</td>
                    <td><strong>' . $account->username . '</strong></td>
                    <td>' .'**********'. '</td>
                    <td>' . $account->fullname . '</td>
                    <td>' .$a. '</td>
                    ' . $b. '
                    <td>
                    <a href="/admin/account/detail/'.$account->id.'" class="btn btn-info "><i class="mdi mdi-eye"></i></a>
                    <a href="/admin/account/update/'.$account->id.'" class="btn btn-primary"><i class="mdi mdi-account-edit"></i></a>
                    </td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
    
}
