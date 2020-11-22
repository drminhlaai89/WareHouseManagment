<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;


class ImportController extends Controller
{
    public function index(){
        $imports = DB::table('import')->where('importtype',0)
        ->join('supplier','supplier.supplierid','=','import.importsupplier_id')->orderBy('import.importid', 'desc')
        ->paginate(8);
        
        return view('import.index')->with([
            'imports'=>$imports
        ]);

    }
    public function create(){
        $suppliers = DB::table('supplier')->get();
        return view('import.create')->with([
            'suppliers'=>$suppliers,
        ]);
    }
    public function searchSupplier(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $suppliers = DB::table('supplier')->where('suppliername', 'LIKE', '%' . $request->search . '%')->get();
            if ($suppliers) {
                foreach ($suppliers as $key => $supplier) {
                    $output .= '<tr>
                    <td>' . $supplier->supplierid . '</td>
                    <td>' . $supplier->suppliername . '</td>
                    <td>' . $supplier->supplieraddress . '</td>
                    <td>' . $supplier->supplierphone . '</td>
                    <td><a href="/import/'.$supplier->supplierid.'" class="btn btn-primary btn-sm">Select</a></td>
                    
                    </tr>';
                }
            }
            
            return Response($output);
        }
    }
    public function product($id){
        $products = DB::table('product')->get();
        return view('import.product')->with([
            'id'=>$id,
            'products'=>$products
        ]);
    }
    public function searchProduct(Request $request)
    {  
        if ($request->ajax()) {
            $output = '';
            $suppliers = DB::table('product')->where('productname', 'LIKE', '%' . $request->search . '%')->get();
            if ($suppliers) {
                foreach ($suppliers as $key => $product) {
                    $output .= '<tr>
                    <td>' . $product->productid . '</td>
                    <td>' . $product->productname . '</td>
                    <td>' . $product->productprice . '</td>
                    <td><a href="/import/'.$request->id.'/product/'.$product->productid.'" class="btn btn-primary btn-sm">Select</a></td>
                    
                    </tr>';
                }
            }
            
            return Response($output);
        }
    }
    public function import($supplierid,$productid ){
        $supplier = DB::table('supplier')->where('supplierid',intval($supplierid))->first();
        $product = DB::table('product')->where('productid',intval($productid))->first();
        return view('import.import')->with([
            'product'=>$product,
            'supplier'=>$supplier
        ]);
    }
    public function createImport(Request $request,$supplierid,$productid){
        $status_order =0;
        $status_transaction=0;
        $status_shipping =0;
        $note = $request->input('txtNote');
        $createddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $createdby = session()->get('user')->username;
        $quantity = intval($request->input('txtQuantity'));
        $product = DB::table('product')->where('productid',intval($productid))->first();
        $amount = intval($product->productprice)*$quantity;
        DB::beginTransaction();
        try {
        $importid = DB::table('import')->insertGetId([
            'importtype'=>0,
            'importsupplier_id' =>intval($supplierid),
            'importstatus_order' => $status_order,
            'importstatus_transaction' => $status_transaction,
            'importstatus_shipping' => $status_transaction,
            'importnote' => $note,
            'importcreateddate' =>$createddate,
            'importcreatedby' =>$createdby
        ]);
        $importorderid = 'ABCYC19292'.$importid;
        DB::table('import')->where('importid',intval($importid))->update([
            'importorderid'=>$importorderid
        ]);
        
        DB::table('detailimport')->insert([
            'detailimportimport_id' =>$importid,
            'detailimportproduct_id' => intval($productid),
            'detailimportquantity' => $quantity,
            'detailimportamount' => $amount,
            'detailimportnote' =>$note,
            'detailimportcreateddate' =>$createddate,
            'detailimportcreatedby' =>$createdby
        ]);
        $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($productid))->first();
        $inventoryinstockold = $inventory->inventoryinstock;
        DB::table('inventory')->where('inventoryproduct_id',intval($productid))->update([
            // 'inventoryinstock' => $inventoryinstockold - $quantity,
            'inventoryquanlity_of_import' => $inventory->inventoryquanlity_of_import +  $quantity,
        ]);
        DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            
            return redirect()->action('ImportController@index');
        }
        return redirect()->action('ImportController@detail',['id'=>$importid]);
    }
    public function detail($id){
        $detailimport=DB::table('detailimport')->where('detailimportimport_id',intval($id))->first();
        $import = DB::table('import')->where('importid',intval($id))->first();
        $supplier = DB::table('supplier')->where('supplierid',intval($import->importsupplier_id))->first();
        $productid = $detailimport->detailimportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        
        return view('import.detail')->with([
            'detailimport'=>$detailimport,
            'supplier'=>$supplier,
            'import' =>$import,
            'product'=>$product
        ]);
    }
    public function invoice($id){
        $detailimport=DB::table('detailimport')->where('detailimportimport_id',intval($id))->first();
        $import = DB::table('import')->where('importid',intval($id))->first();
        $supplier = DB::table('supplier')->where('supplierid',intval($import->importsupplier_id ))->first();
        $productid = $detailimport->detailimportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        $data=([
            'detailimport'=>$detailimport,
            'supplier'=>$supplier,
            'import' =>$import,
            'product'=>$product
        ]);
        $pdf = PDF::loadView('import.invoice',compact('data'));
        return $pdf->download('invoice.pdf');
    }
    public function update($id){
        $detailimport=DB::table('detailimport')->where('detailimportimport_id',intval($id))->first();
        $import = DB::table('import')->where('importid',intval($id))->first();
        $supplier = DB::table('supplier')->where('supplierid',intval($import->importsupplier_id ))->first();
        $productid = $detailimport->detailimportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        if($import->importstatus_shipping ==1){
            return redirect()->action('ImportController@updateTransaction',['id'=>$id]); 
        }else{
            return view('import.update-shipping')->with([
                'detailimport'=>$detailimport,
                'supplier'=>$supplier,
                'import' =>$import,
                'product'=>$product
            ]);
        }
        
        
    }
    public function postUpdate(Request $request, $id){
        $importstatus_transaction = $request->input('importstatus_transaction');
        $importstatus_shipping = $request->input('importstatus_shipping');
        if($importstatus_shipping ==2){
            $importstatus_transaction =2;
        }else{
            $importstatus_transaction =0;
        }
       
        $note =$request->input('txtNote');
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('import')->where('importid',intval($id))->update([
            'importstatus_transaction'=>$importstatus_transaction,
            'importstatus_shipping'=>intval($importstatus_shipping),
            'importnote'=>$note,
            'importmodifieddate'=>$modifieddate,
            'importmodifiedby'=>$modifiedby

        ]);
        if($importstatus_shipping==1){
            return redirect()->action('ImportController@updateTransaction',['id'=>$id]); 
        }else{
            return redirect()->action('ImportController@detail',['id'=>$id]); 
        }
        
    }
    public function cancelShipping($id){
        
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('import')->where('importid',intval($id))->update([
            'importstatus_transaction'=>0,
            'importstatus_shipping'=>0,
            
            'importmodifieddate'=>$modifieddate,
            'importmodifiedby'=>$modifiedby

        ]);
       
        return redirect()->action('ImportController@update',['id'=>$id]); 
    }


    public function updateTransaction($id){
        $detailimport=DB::table('detailimport')->where('detailimportimport_id',intval($id))->first();
        $import = DB::table('import')->where('importid',intval($id))->first();
        $supplier = DB::table('supplier')->where('supplierid',intval($import->importsupplier_id ))->first();
        $productid = $detailimport->detailimportproduct_id;
        $product = DB::table('product')->where('productid',intval($productid))->first();
        return view('import.update-transaction')->with([
            'detailimport'=>$detailimport,
            'supplier'=>$supplier,
            'import' =>$import,
            'product'=>$product
        ]);
    }

    public function postUpdateTransaction(Request $request ,$id){
        $importstatus_transaction = $request->input('importstatus_transaction');

        $note =$request->input('txtNote');
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('import')->where('importid',intval($id))->update([
            'importstatus_transaction'=>intval($importstatus_transaction),
            'importnote'=>$note,
            'importmodifieddate'=>$modifieddate,
            'importmodifiedby'=>$modifiedby

        ]);
        $detailimport = DB::table('detailimport')->where('detailimportimport_id',intval($id))->first();
        $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($detailimport->detailimportproduct_id ))->first();
        if(intval($importstatus_transaction)==1){
            DB::table('inventory')->where('inventoryproduct_id',intval($detailimport->detailimportproduct_id))->update([
            'inventoryquanlity_of_import' =>$inventory->inventoryquanlity_of_import- $detailimport->detailimportquantity,
            'inventoryinstock' =>$inventory->inventoryinstock + $detailimport->detailimportquantity
        ]);
        }
        if(intval($importstatus_transaction==2)){
            DB::table('inventory')->where('inventoryproduct_id',intval($detailimport->detailimportproduct_id))->update([
            'inventoryquanlity_of_import' =>$inventory->inventoryquanlity_of_import- $detailimport->detailimportquantity,    
            ]);
        }
        return redirect()->action('ImportController@detail',['id'=>$id]); 
    }



    public function pending(){
        $imports = DB::table('import')->orderBy('import.importid', 'desc')
        ->join('supplier',function($join){
            $join->on('supplier.supplierid','=','import.importsupplier_id')
            ->where('importstatus_order',intval(0)
        );
        })
        ->get();
        
        return view('admin.import')->with([
            'imports'=>$imports
        ]);

    }
    public function accept($id){
        DB::table('import')->where('importid',intval($id))->update([
            'importstatus_order'=>1,
            
        ]);
        return redirect()->action('ImportController@pending');
    }
    public function cancel($id){
        DB::table('import')->where('importid',intval($id))->update([
            'importstatus_order'=>2,
            'importstatus_transaction' =>2,
            'importstatus_shipping' =>2,
        ]);
        $detailimport = DB::table('detailimport')->where('detailimportimport_id',intval($id))->first();
        $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($detailimport->detailimportproduct_id))->first();
        DB::table('inventory')->where('inventoryproduct_id',intval($detailimport->detailimportproduct_id))->update([
            'inventoryquanlity_of_import' =>$inventory->inventoryquanlity_of_import- $detailimport->detailimportquantity,
            ]);
        return redirect()->action('ImportController@pending');
    }
    public function return(){
        $imports = DB::table('import')->where([
            'importtype'=>1,
            ])
        ->join('supplier','supplier.supplierid','=','import.importsupplier_id')->orderBy('import.importid', 'desc')
        ->get();
        
        return view('returnimport.index')->with([
            'imports'=>$imports
        ]);
    }
    public function returnCreate(){
        $imports = DB::table('import')->where([
            'importtype'=>0,
            'importstatus_transaction'=>1
            ])
        ->join('supplier','supplier.supplierid','=','import.importsupplier_id')->orderBy('import.importid', 'desc')
        ->get();
        
        return view('returnimport.create')->with([
            'imports'=>$imports
        ]);
    }
    public function getCreateReturn($id){
        $import = DB::table('import')->where('importid',intval($id))
        ->join('supplier','supplier.supplierid','=','import.importsupplier_id')->orderBy('import.importid', 'desc')
        ->first();
        $detailimport = DB::table('detailimport')->where('detailimportimport_id',($import->importid ))->first();
        $product = DB::table('product')->where('productid',($detailimport->detailimportproduct_id))->first();
        return view('returnimport.return')->with([
            'import'=>$import,
            'detailimport'=>$detailimport,
            'product'=>$product
        ]);
    }
    public function postCreateReturn(Request $request, $id){
        $createddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $createdby = session()->get('user')->username;
        $import = DB::table('import')->where('importid',intval($id))
        ->join('supplier','supplier.supplierid','=','import.importsupplier_id')->orderBy('import.importid', 'desc')
        ->first();
        $detailimport = DB::table('detailimport')->where('detailimportimport_id',($import->importid ))->first();
        $product = DB::table('product')->where('productid',($detailimport->detailimportproduct_id))->first();
        DB::beginTransaction();
        try {
        $importid = DB::table('import')->insertGetId([
            'importtype'=>1,
            'importorderid'=>$import->importorderid,
            'importsupplier_id' =>$import->supplierid,
            'importstatus_order' => 0,
            'importstatus_transaction' => 0,
            'importstatus_shipping' => 0,
            'importnote' => intval($request->input('note')),
            'importcreateddate' =>$createddate,
            'importcreatedby' =>$createdby
        ]);
        
        DB::table('detailimport')->insert([
            'detailimportimport_id' =>$importid,
            'detailimportproduct_id' => $product->productid,
            'detailimportquantity' =>   intval($request->input('quantity')),
            'detailimportamount' => intval($request->input('quantity'))*$product->productprice,
            'detailimportnote' =>intval($request->input('note')),
            'detailimportcreateddate' =>$createddate,
            'detailimportcreatedby' =>$createdby
        ]);
        $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($product->productid))->first();
        $inventoryinstockold = $inventory->inventoryinstock;
        DB::table('inventory')->where('inventoryproduct_id',intval($product->productid))->update([
            // 'inventoryinstock' => $inventoryinstockold - $quantity,
            'inventoryquanlity_of_import' => $inventory->inventoryquanlity_of_import +  intval($request->input('quantity')),
        ]);
        DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            
            return redirect()->action('ImportController@return');
        }
        return redirect()->action('ImportController@detail',['id'=>$importid]);
    }


    public function searchImport(Request $request)
    {
        if ($request->ajax()) {
            $a = '';
            $b = '';
            $c = '';
            $output = '';
            $imports = DB::table('import')
            ->where('importorderid','LIKE', '%' . $request->search . '%')
            ->join('supplier',function($join){
                $join->on('supplier.supplierid','=','import.importsupplier_id')
                ->where('importstatus_order',intval(0)
            );
            })
           
            ->get();
            if ($imports) {
                foreach ($imports as $key => $import) {
                    if($import->importstatus_order==0){
                        $a = '<span class="btn btn-warning">Processing</span>';
                    }else if($import->importstatus_order==1){
                        $a = '<span class="btn btn-success">Accept</span>';
                    }else{
                        $a = '<span class="btn btn-danger">Cancel</span>';
                    }
                    if($import->importstatus_transaction==0){
                        $b = ('<span class="btn btn-warning">Processing</span>');
                        }else if($import->importstatus_transaction==1){
                        $b = ('<span class="btn btn-success">Done</span>');
                        }else{
                        $b = ('<span class="btn btn-danger">Cancel</span>');
                        }
                    if($import->importstatus_shipping==0){
                            $c = ('<span class="btn btn-warning">Processing</span>');
                            }else if($import->importstatus_shipping==1){
                            $c = ('<span class="btn btn-success">Done</span>');
                            }else{
                            $c = ('<span class="btn btn-danger">Cancel</span>');
                            }
                    $output .= '<tr>
                    <td>' . $import->importorderid . '</td>
                    <td>' . $import->suppliername . '</td>
                    <td>' . $import->importcreateddate . '</td>
                    <td>' . $a . '</td>
                    <td>' . $b . '</td>
                    <td>' . $c . '</td>
                    <td>
                    <a href="/import/detail/'.$import->importid.'" class="btn btn-info "><i class="mdi mdi-eye"></i></a>
                    <a href="/import/update/'.$import->importid.'" class="btn btn-primary"><i class="mdi mdi-account-edit"></i></a>
                    </td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    public function searchPending(Request $request){
        if ($request->ajax()) {
            $a = '';
            $b = '';
            $c = '';
            $output = '';
            $imports = DB::table('import')
            ->where('importorderid','LIKE', '%' . $request->search . '%')
            ->join('supplier','supplier.supplierid','=','import.importsupplier_id')
            ->get();
            if ($imports) {
                foreach ($imports as $key => $import) {
                    if($import->importtype==0){
                        $a = ('<td class="text-success">Order</td>');
                        }else if($import->importtype==1){
                            $a =  '<td class="text-danger">Return</td>';
                        }else{
                            $a =  '<td class="text-warning"> PreOrder </td>';
                        }
                        if($import->importstatus_transaction==0){
                            $b = ('<td class="text-warning">Processing</td>');
                            }else if($import->importstatus_transaction==1){
                                $b =  '<td class="text-success"> Done </td>';
                            }else{
                                $b =  '<td class="text-danger"> Cancel </td>';
                            }
                    $output .= '<tr>
                    <td>' . $import->importorderid . '</td>
                    <td>' . $import->suppliername . '</td>
                    <td>' . $import->importcreateddate . '</td>
                    ' . $a . '
                    ' . $b . '
                    
                    <td>
                    <button class="btn btn-outline-primary"><a
                        href="/import/detail/'.$import->importid.'">Detail</a></button>
                    <button class="btn btn-outline-success"><a
                        href="/admin/import/accept/'. $import->importid .'">Accept</a></button>
                   <button class="btn btn-outline-success"><a
                        href="/admin/import/cancel/'.$import->importid.'">Cancel</a></button>
                    </td>
                 </tr>';
                }
            }
            return Response($output);
        }
    }
}
