<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function index(){
        $exports = DB::table('export')->where('exporttype',0)
        ->join('customer','customer.customerid','=','export.exportcustomer_id')->orderBy('export.exportid', 'desc')
        ->paginate(8);
        return view('export.index')->with([
            'exports'=>$exports,
        ]);

    }
    

    public function create(){
        $products = DB::table('product')->get();
        return view('export/create')->with([
            'products'=>$products,
        ]);
    }
    public function searchProduct(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products = DB::table('product')->where('productname', 'LIKE', '%' . $request->search . '%')->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<tr>
                    <td>' . $product->productid . '</td>
                    <td><strong>' . $product->productname . '</strong></td>
                    <td>' . $product->productprice . '</td>
                    <td><a href="/export/'.$product->productid.'" class="btn btn-primary btn-sm">Select</a></td>
                    </tr>';
                }
            }
            
            return Response($output);
        }
    }

    public function customer($customerid){
        $customers = DB::table('customer')->get();
        return view('export.customer')->with([
            'customerid'=>$customerid,
            'customers'=>$customers
        ]);
    }
    public function searchCustomer(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $customers = DB::table('customer')
            ->where('customername', 'LIKE', '%' . $request->search . '%')
            ->orwhere('customerphone', 'LIKE', '%' . $request->search . '%')
            ->orwhere('customeremail', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($customers) {
                foreach ($customers as $key => $customer) {
                    $output .= '<tr>
                    <td>' . $customer->customerid . '</td>
                    <td><strong>' . $customer->customername . '</strong></td>
                    <td>' . $customer->customeremail . '</td>
                    <td>' . $customer->customerphone . '</td>
                    <td>' . $customer->customeraddress . '</td>
                    <td><a href="/export/'.$request->id.'/customer/'.$customer->customerid.'" class="btn btn-primary btn-sm">Select</a></td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    public function export($productid,$customerid ){
        $customer = DB::table('customer')->where('customerid',intval($customerid))->first();
        
        $product = DB::table('product')->where('productid',intval($productid))->first();
        return view('export.export')->with([
            'product'=>$product,
            'customer'=>$customer
        ]);
    }

    public function createExport(Request $request,$productid,$customerid){
        $exportstatus_order=0;
        $exportstatus_shipping =0;
        $exportstatus_transaction =0;
        $exportnote = $request->input('txtNote');
        $exportcreateddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $exportcreatedby = session()->get('user')->username;
        $detailexportquantity = intval($request->input('txtQuantity'));
        $product = DB::table('product')->where('productid',intval($productid))->first();
        $detailexportamount = intval($product->productprice)*$detailexportquantity;
        DB::beginTransaction();
    try {
        $exportid = DB::table('export')->insertGetId([
            'exportcustomer_id' =>intval($customerid),
            'exporttype'=>0,
            'exportstatus_order' => $exportstatus_order,
            'exportstatus_transaction' => $exportstatus_transaction,
            'exportstatus_shipping' => $exportstatus_transaction,
            'exportnote' => $exportnote,
            'exportcreateddate' =>$exportcreateddate,
            'exportcreatedby' =>$exportcreatedby
        ]);
        $exportorderid = 'DECYC19292'.$exportid;
        DB::table('export')->where('exportid',intval($exportid))->update([
            'exportorderid'=>$exportorderid
        ]);
        DB::table('detailexport')->insert([
            'detailexportexport_id' =>$exportid,
            'detailexportproduct_id' => intval($productid),
            'detailexportquantity' => $detailexportquantity,
            'detailexportamount' => $detailexportamount,
            'detailexportnote' =>intval($exportnote),
            'detailexportcreateddate' =>$exportcreateddate,
            'detailexportcreatedby' =>$exportcreatedby
        ]);
        $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($productid))->first();
        DB::table('inventory')->where('inventoryproduct_id',intval($productid))->update([
            'inventoryinstock' => $inventory->inventoryinstock - $detailexportquantity,
            'inventoryquanlity_of_export' => $inventory->inventoryquanlity_of_export +  $detailexportquantity,
        ]);
        
        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        
        return redirect()->action('ExportController@index');
    }
        
        return redirect()->action('ExportController@detail',['id'=>$exportid]);
    }

    public function update($id){
        $detailexport=DB::table('detailexport')->where('detailexportexport_id',intval($id))->first();
        $export = DB::table('export')->where('exportid',intval($id))->first();
        $productid = $detailexport->detailexportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        // $customertid = $detailexport->detailexportcustomer_id;
        $customer = DB::table('customer')->where('customerid',intval($export->exportcustomer_id ))->first();
       
        if($export->exportstatus_shipping ==1){
            return redirect()->action('ExportController@updateTransaction',['id'=>$id]); 
        }else{
            return view('export.update-shipping')->with([
                'detailexport'=>$detailexport,
                'customer'=>$customer,
                'export' =>$export,
                'product'=>$product
            ]);
        }
    }
    public function postUpdate(Request $request, $id){
        $exportstatus_transaction = $request->input('exportstatus_transaction');
        $exportstatus_shipping = $request->input('exportstatus_shipping');
        if($exportstatus_shipping ==2){
            $exportstatus_transaction =2;
        }else{
            $exportstatus_transaction =0;
        }
        $note =$request->input('txtNote');
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('export')->where('exportid',intval($id))->update([
            'exportstatus_transaction'=>intval($exportstatus_transaction),
            'exportstatus_shipping'=>intval($exportstatus_shipping),
            'exportnote'=>$note,
            'exportmodifieddate'=>$modifieddate,
            'exportmodifiedby'=>$modifiedby
        ]);
        
        if($exportstatus_shipping==1){
            return redirect()->action('ExportController@updateTransaction',['id'=>$id]); 
        }else{
            return redirect()->action('ExportController@detail',['id'=>$id]); 
        }
    }
    public function cancelShipping($id){
        
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('export')->where('exportid',intval($id))->update([
            'exportstatus_transaction'=>0,
            'exportstatus_shipping'=>0,
            
            'exportmodifieddate'=>$modifieddate,
            'exportmodifiedby'=>$modifiedby

        ]);
       
        return redirect()->action('ExportController@update',['id'=>$id]); 
    }

    public function updateTransaction($id){
        $detailexport=DB::table('detailexport')->where('detailexportexport_id',intval($id))->first();
        $export = DB::table('export')->where('exportid',intval($id))->first();
        $productid = $detailexport->detailexportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        // $customertid = $detailexport->detailexportcustomer_id;
        $customer = DB::table('customer')->where('customerid',intval($export->exportcustomer_id ))->first();
        return view('export.update-transaction')->with([
            'detailexport'=>$detailexport,
            'customer'=>$customer,
            'export' =>$export,
            'product'=>$product
        ]);
    }
    public function postUpdateTransaction(Request $request, $id){
        $exportstatus_transaction = $request->input('exportstatus_transaction');
        
        $note =$request->input('txtNote');
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('export')->where('exportid',intval($id))->update([
            'exportstatus_transaction'=>intval($exportstatus_transaction),
            'exportnote'=>$note,
            'exportmodifieddate'=>$modifieddate,
            'exportmodifiedby'=>$modifiedby
        ]);
        $detailexport = DB::table('detailexport')->where('detailexportexport_id',intval($id))->first();
        $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($detailexport->detailexportproduct_id))->first();
        //giao dich done
        if(intval($exportstatus_transaction)==1){
            DB::table('inventory')->where('inventoryproduct_id',intval($detailexport->detailexportproduct_id))->update([
            'inventoryquanlity_of_export' =>$inventory->inventoryquanlity_of_export- $detailexport->detailexportquantity,
            
        ]);
        }
        //giao dich huy
        if(intval($exportstatus_transaction==2)){
            DB::table('inventory')->where('inventoryproduct_id',intval($detailexport->detailexportproduct_id))->update([
            'inventoryinstock' =>$inventory->inventoryinstock + $detailexport->detailexportquantity,
            'inventoryquanlity_of_export' =>$inventory->inventoryquanlity_of_export- $detailexport->detailexportquantity,    
            ]);
        }
        return redirect()->action('ExportController@detail',['id'=>$id]); 
    }
    
    public function detail($id){
        $detailexport=DB::table('detailexport')->where('detailexportexport_id',intval($id))->first();
        $export = DB::table('export')->where('exportid',intval($id))->first();
        $customer = DB::table('customer')->where('customerid',intval($export->exportcustomer_id ))->first();
        $productid = $detailexport->detailexportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        
        return view('export.detail')->with([
            'detailexport'=>$detailexport,
            'customer'=>$customer,
            'export' =>$export,
            'product'=>$product
        ]);
    }

    public function invoice($id){
        $detailexport=DB::table('detailexport')->where('detailexportexport_id',intval($id))->first();
        $export = DB::table('export')->where('exportid',intval($id))->first();
        $customer = DB::table('customer')->where('customerid',intval($export->exportcustomer_id ))->first();
        $productid = $detailexport->detailexportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        $data=([
            'detailexport'=>$detailexport,
            'customer'=>$customer,
            'export' =>$export,
            'product'=>$product
        ]);
        $pdf = PDF::loadView('export.invoice',compact('data'));
        return $pdf->download('invoice.pdf');
    }

    public function pending(){
        $exports = DB::table('export')->orderBy('export.exportid', 'desc')
        ->join('customer',function($join){
            $join->on('customer.customerid','=','export.exportcustomer_id')
            ->where('exportstatus_order',intval(0)
            );
            
        })
        ->get();
        // $export = $exports->reorder('importid','desc')->get();
        return view('admin.export')->with([
            'exports'=>$exports
        ]);
    }

    public function accept($id){
        DB::table('export')->where('exportid',intval($id))->update([
            'exportstatus_order'=>1,
        ]);
        return redirect()->action('ExportController@pending');
    }
    public function cancel($id){
        DB::table('export')->where('exportid',intval($id))->update([
            'exportstatus_order'=>2,
            'exportstatus_transaction'=>2,
            'exportstatus_shipping'=>2    
        ]);
        $detailexport = DB::table('detailexport')->where('detailexportexport_id',intval($id))->first();
        $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($detailexport->detailexportproduct_id))->first();
        DB::table('inventory')->where('inventoryproduct_id',intval($detailexport->detailexportproduct_id))->update([
            'inventoryquanlity_of_export' =>$inventory->inventoryquanlity_of_export- $detailexport->detailexportquantity,
            'inventoryinstock' =>$inventory->inventoryinstock + $detailexport->detailexportquantity
            ]);
        return redirect()->action('ExportController@pending');
    }
    public function return(){
        $exports = DB::table('export')->where('exporttype',1)
        ->join('customer','customer.customerid','=','export.exportcustomer_id')->orderBy('export.exportid', 'desc')
        ->get();
        return view('returnexport.index')->with([
            'exports'=>$exports,
        ]);
    }
    public function returnCreate(){
        $exports = DB::table('export')->where([
            'exporttype'=>0,
            'exportstatus_transaction'=>1
            ])
            ->join('customer','customer.customerid','=','export.exportcustomer_id')->orderBy('export.exportid', 'desc')
            ->get();
        return view('returnexport.create')->with([
            'exports'=>$exports,
        ]);
    }
    public function getCreateReturn($id){
        $export = DB::table('export')->where('exportid',intval($id))
        ->join('customer','customer.customerid','=','export.exportcustomer_id')->orderBy('export.exportid', 'desc')
        ->first();
        
        $detailexport=DB::table('detailexport')->where('detailexportexport_id',intval($id))->first();
        $productid = $detailexport->detailexportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        return view('returnexport.return')->with([
            'export'=>$export,
            'detailexport'=>$detailexport,
            'product'=>$product
        ]);
    }
    public function postCreateReturn(Request $request, $id){
        $createddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $createdby = session()->get('user')->username;
        $export = DB::table('export')->where('exportid',intval($id))
        ->join('customer','customer.customerid','=','export.exportcustomer_id')->orderBy('export.exportid', 'desc')
        ->first();
        $detailexport=DB::table('detailexport')->where('detailexportexport_id',intval($id))->first();
        $productid = $detailexport->detailexportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        DB::beginTransaction();
        try {
        $exportid = DB::table('export')->insertGetId([
            'exporttype'=>1,
            'exportorderid'=>$export->exportorderid,
            'exportcustomer_id' =>$export->exportcustomer_id,
            'exportstatus_order' => 0,
            'exportstatus_transaction' => 0,
            'exportstatus_shipping' => 0,
            'exportnote' => intval($request->input('note')),
            'exportcreateddate' =>$createddate,
            'exportcreatedby' =>$createdby
        ]);
        
        DB::table('detailexport')->insert([
            'detailexportexport_id' =>$exportid,
            'detailexportproduct_id' => $product->productid,
            'detailexportquantity' =>   intval($request->input('quantity')),
            'detailexportamount' => intval($request->input('quantity'))*$product->productprice,
            'detailexportnote' =>intval($request->input('note')),
            'detailexportcreateddate' =>$createddate,
            'detailexportcreatedby' =>$createdby
        ]);
        $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($product->productid))->first();
        $inventoryinstockold = $inventory->inventoryinstock;
        DB::table('inventory')->where('inventoryproduct_id',intval($product->productid))->update([
            // 'inventoryinstock' => $inventoryinstockold - $quantity,
            'inventoryquanlity_of_import' => $inventory->inventoryquanlity_of_import -  intval($request->input('quantity')),
        ]);
        DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            
            return redirect()->action('ExportController@return');
        }
        return redirect()->action('ExportController@return');
    }

    public function preorder(){
        $exports = DB::table('export')->where('exporttype',2)
        ->join('customer','customer.customerid','=','export.exportcustomer_id')->orderBy('export.exportid', 'desc')
        ->get();
        return view('preorder.index')->with([
            'exports'=>$exports
        ]);
    }
    
    public function preorderCustomer(){
        $customers = DB::table('customer')->get();
        return view('preorder.customer')->with([
            'customers'=>$customers
        ]);
    }
    public function preorderProduct($id){
        $products = DB::table('product')->get();
        return view('preorder.product')->with([
            'products'=>$products,
            'id' =>$id
        ]);
    }

    public function preorderCreate($customerid, $productid){
        $customer = DB::table('customer')->where('customerid',intval($customerid))->first();
        
        $product = DB::table('product')->where('productid',intval($productid))->first();
        return view('preorder.create')->with([
            'customer'=>$customer,
            'product'=>$product
        ]);
    }

    public function preorderPostCreate(Request $request, $customerid, $productid){
        $exportstatus_order=0;
        $exportstatus_shipping =0;
        $exportstatus_transaction =0;
        $exportnote = $request->input('txtNote');
        $exportcreateddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $exportcreatedby = session()->get('user')->username;
        $detailexportquantity = intval($request->input('txtQuantity'));
        $product = DB::table('product')->where('productid',intval($productid))->first();
        $detailexportamount = intval($product->productprice)*$detailexportquantity;
        DB::beginTransaction();
    try {
        $exportid = DB::table('export')->insertGetId([
            'exportcustomer_id' =>intval($customerid),
            'exporttype'=>2,
            'exportstatus_order' => $exportstatus_order,
            'exportstatus_transaction' => $exportstatus_transaction,
            'exportstatus_shipping' => $exportstatus_transaction,
            'exportnote' => $exportnote,
            'exportcreateddate' =>$exportcreateddate,
            'exportcreatedby' =>$exportcreatedby
        ]);
        $exportorderid = 'DECYC19292'.$exportid;
        DB::table('export')->where('exportid',intval($exportid))->update([
            'exportorderid'=>$exportorderid
        ]);
        DB::table('detailexport')->insert([
            'detailexportexport_id' =>$exportid,
            'detailexportproduct_id' => intval($productid),
            'detailexportquantity' => $detailexportquantity,
            'detailexportamount' => $detailexportamount,
            'detailexportnote' =>intval($exportnote),
            'detailexportcreateddate' =>$exportcreateddate,
            'detailexportcreatedby' =>$exportcreatedby
        ]);
        
        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        
        return redirect()->action('ExportController@preorder');
    }
        
    return redirect()->action('ExportController@detail',['id'=>$exportid]);
    }

    public function searchExport(Request $request)
    {
        if ($request->ajax()) {
            $a = $b =$c = '';
            $output = '';
            $exports = DB::table('export')
            ->where('exportorderid','LIKE', '%' . $request->search . '%')
            ->join('customer','customer.customerid','=','export.exportcustomer_id')
            ->get();
            if ($exports) {
                foreach ($exports as $key => $export) {
                    if($export->exportstatus_order==0){
                        $a = ('<span class="btn btn-warning">Processing</span>');
                    }else if($export->exportstatus_order==1){
                        $a = ('<span class="btn btn-success">Accept</span>');
                    }else{
                        $a = ('<span class="btn btn-danger">Cancel</span>');
                    }
                    if($export->exportstatus_transaction==0){
                        $b = ('<span class="btn btn-warning">Processing</span>');
                        }else if($export->exportstatus_transaction==1){
                        $b = ('<span class="btn btn-success">Done</span>');
                        }else{
                        $b = ('<span class="btn btn-danger">Cancel</span>');
                        }
                        if($export->exportstatus_shipping==0){
                            $c = ('<span class="btn btn-warning">Processing</span>');
                            }else if($export->exportstatus_shipping==1){
                            $c = ('<span class="btn btn-success">Done</span>');
                            }else{
                            $c = ('<span class="btn btn-danger">Cancel</span>');
                            }
                    $output .= '<tr>
                    <td>' . $export->exportorderid . '</td>
                    <td>' . $export->customername . '</td>
                    <td>' . $export->exportcreateddate . '</td>
                    <td>' . $a . '</td>
                    <td>' . $b . '</td>
                    <td>' . $c . '</td>
                    <td>
                    <a href="/export/detail/'.$export->exportid.'" class="btn btn-info "><i class="mdi mdi-eye"></i></a>
                    <a href="/export/update/'.$export->exportid.'" class="btn btn-primary"><i class="mdi mdi-account-edit"></i></a>
                    </td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    public function searchPending(Request $request){
        if ($request->ajax()) {
            $a = $b =$c = '';
            $output = '';
            $exports = DB::table('export')->where('exportorderid','LIKE', '%' . $request->search . '%')
            ->join('customer',function($join){
                $join->on('customer.customerid','=','export.exportcustomer_id')
                ->where('exportstatus_order',intval(0)
                );
                
            })
            ->get();
            if ($exports) {
                foreach ($exports as $key => $export) {
                    if($export->exporttype==0){
                        $a = ('<td class="text-success">Order</td>');
                        }else if($export->exporttype==1){
                            $a =  '<td class="text-danger">Return</td>';
                        }else{
                            $a =  '<td class="text-warning"> PreOrder </td>';
                        }
                        if($export->exportstatus_transaction==0){
                            $b = ('<td class="text-warning">Processing</td>');
                            }else if($export->exportstatus_transaction==1){
                                $b =  '<td class="text-success"> Done </td>';
                            }else{
                                $b =  '<td class="text-danger"> Cancel </td>';
                            }
                        
                    $output .= '<tr>
                    <td>' . $export->exportorderid . '</td>
                    <td>' . $export->customername . '</td>
                    <td>' . $export->exportcreateddate . '</td>
                    ' . $a . '
                    ' . $b . '
                    
                    <td>
                    <button class="btn btn-outline-primary"><a
                            href="/export/detail/'.$export->exportid.'">Detail</a></button>
                    <button class="btn btn-outline-success"><a
                            href="/admin/export/accept/'.$export->exportid .'">Accept</a></button>
                    <button class="btn btn-outline-success"><a
                            href="/admin/export/cancel/'. $export->exportid .'">Cancel</a></button>
                </td>
            </tr>';
                }
            }
            return Response($output);
    }}
}
