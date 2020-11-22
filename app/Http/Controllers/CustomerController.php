<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(){
        $customers =  DB::table ('customer')->get();
        return view("customer.index")->with([
            'customers' => $customers
        ]);
    }

    public function create(){
        return view('customer.create')->with([]);
    }

    public function postCreate(Request $request){
        $id = $request->input('txtid');
        $name = $request->input('txtname');
        $type = $request->input('txttype');
        $Email = $request->input('txtemail');
        $Phone = $request->input('txtPhone');
        $Address = $request->input('txtaddress');
        $status = $request->input('txtstatus');
        $note = $request->input('txtnote');
        $createddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $createdby = session()->get('user')->username;
        DB::table('customer')->insert([
            'customerid' => $id,
            'customername' => $name,
            'customertype' => $type,
            'customeremail' => $Email,
            'customerphone' => $Phone,
            'customeraddress' => $Address,
            'customerstatus' => $status,
            'customernote' => $note,
            'customercreateddate'=>$createddate,
            'customercreatedby'=>$createdby
        ]);
        return redirect()->action("CustomerController@index");
    }
    public function detail($id){
        $cus = DB::table('customer')->where('customerid',intval($id))->first();
        return view ('customer.detail',['cus'=>$cus])->with(['customerid'=> $id]);
    }

    public function update($id){
        $c = DB::table('customer')->where('customerid', intval($id))->first();
        return view('customer.update', ['c' => $c]);
    }

    public function postUpdate(Request $request, $id){
        $name = $request->input('txtname');
        $type = $request->input('txttype');
        $Email = $request->input('txtemail');
        $Phone = $request->input('txtphone');
        $Address = $request->input('txtaddress');
        $status = $request->input('txtstatus');
        $note = $request->input('txtnote');
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('customer')
            ->where('customerid', intval($id))
            ->update([
                'customername' => $name,
                'customertype' => $type,
                'customeremail' => $Email,
                'customerphone' => $Phone,
                'customeraddress' => $Address,
                'customerstatus' => $status,
                'customernote' => $note,
                'customermodifieddate' =>$modifieddate,
                'customermodifiedby' =>$modifiedby
            ]);
            return redirect()->action("CustomerController@index");
    }
    public function searchCustomer(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $customers = DB::table('customer')
            ->where('customername', 'LIKE', '%' . $request->search . '%')
            ->orwhere ('customerphone', 'LIKE', '%' . $request->search . '%')
            ->orwhere ('customeremail', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($customers) {
                foreach ($customers as $key => $customer) {
                    $output .= '<tr>
                    <td>' . $customer->customerid . '</td>
                    <td><strong>' . $customer->customername . '</strong></td>
                    <td>' . $customer->customeremail . '</td>
                    <td>' . $customer->customerphone . '</td>
                    <td>' . $customer->customeraddress . '</td>
                    <td>
                    <a href="/customer/detail/'.$customer->customerid.'" class="btn btn-info "><i class="mdi mdi-eye"></i></a>
                    <a href="/customer/update/'.$customer->customerid.'" class="btn btn-primary"><i class="mdi mdi-account-edit"></i></a>
                    </td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
            
}
