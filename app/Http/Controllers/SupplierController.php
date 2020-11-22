<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = DB::table('supplier')->get();
        return view ('supplier.index')->with([
            'suppliers' => $suppliers
    ]);
        }
        
        public function create(){
            return view('supplier.create')->with([
            ]);
        }

        public function detail($id){
            $sup = DB::table('supplier')->where('supplierid',intval($id))->first();
            return view ('supplier.detail',['sup'=>$sup])->with(['supplierid'=> $id]);
        }

        public function postCreate(Request $request){
            $name = $request->input('txtname');
            $description = $request->input('txtdescription');         
            $email = $request->input('txtemail');
            $phone = $request->input('txtphone');
            $address = $request->input('txtaddress');
            $status = $request->input('txtstatus');
            $note = $request->input('txtnote');
            $createddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $createdby = session()->get('user')->username;
            DB::table('supplier')->insert([
                'suppliername' => $name,
                'supplierdescription' => $description,
                'supplieremail' => $email,
                'supplierphone' => $phone,
                'supplieraddress' => $address,
                'supplierstatus' => $status,
                'suppliernote' => $note,
                'suppliercreateddate'=>$createddate,
                'suppliercreatedby'=>$createdby
            ]);
            return redirect('supplier');
        }    
    
        public function update($id){
            $c = DB::table('supplier')->where('supplierid',intval($id))->first();
            return view ('supplier.update',['c'=>$c])->with(['supplierid'=> $id]);
        }
    
        public function postUpdate(Request $request,$id){
            $name=$request->input('txtname');
            $description=$request->input('txtdescription');
            $phone = $request->input('txtphone');
            $email=$request->input('txtemail');
            $address=$request->input('txtaddress');
            $status = $request->input('txtstatus');
            $note = $request->input('txtnote');
            $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $modifiedby = session()->get('user')->username;
            DB::table('supplier')
            ->where('supplierid',intval($id))
            ->update([
                'suppliername'=>$name,
                'suppliernote'=>$description,
                'supplierphone'=>$phone,
                'supplieremail'=> $email,
                'supplieraddress'=> $address,
                'supplierstatus' => $status,
                'suppliernote' => $note,
                'suppliermodifieddate' =>$modifieddate,
                'suppliermodifiedby' =>$modifiedby
                ]);
            return redirect()->action("SupplierController@index");
            }

    public function searchSupplier(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $suppliers = DB::table('supplier')
            ->where('suppliername', 'LIKE', '%' . $request->search . '%')
            ->orwhere ('supplierphone', 'LIKE', '%' . $request->search . '%')
            ->orwhere ('supplieremail', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($suppliers) {
                foreach ($suppliers as $key => $supplier) {
                    $output .= '<tr>
                    <td>' . $supplier->supplierid . '</td>
                    <td><strong>' . $supplier->suppliername . '</strong></td>
                    <td>' . $supplier->supplieremail . '</td>
                    <td>' . $supplier->supplierphone . '</td>
                    <td>' . $supplier->supplierstatus . '</td>
                    <td>
                    <a href="/supplier/detail/'.$supplier->supplierid.'" class="btn btn-info "><i class="mdi mdi-eye"></i></a>
                    <a href="/supplier/update/'.$supplier->supplierid.'" class="btn btn-primary"><i class="mdi mdi-account-edit"></i></a>
                    </td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
}
