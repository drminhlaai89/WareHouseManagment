<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(){
        $inventory = DB::table('inventory')
        ->join('product','product.productid','=','inventory.inventoryproduct_id')
        ->get();
        foreach($inventory as $key=> $inventory){
            $totalimport = DB::table('detailimport')->where('detailimportproduct_id',$inventory->inventoryproduct_id)
            ->join('import',function($join){
                $join->on('import.importid','=','detailimport.detailimportimport_id')
                ->where([
                    'import.importstatus_transaction'=> intval(1),
                    'import.importtype'=>0

                    ]);
                
            })
            ->sum('detailimportquantity');
            
            $totalexport = DB::table('detailexport')->where('detailexportproduct_id',$inventory->inventoryproduct_id)
            ->join('export',function($join){
                $join->on('export.exportid','=','detailexport.detailexportexport_id')
                ->where([
                    'export.exportstatus_transaction'=>1,
                    'export.exporttype'=>0

                    ]);
                
            })->sum('detailexportquantity');
            
            DB::table('inventory')->where('inventoryid',intval($inventory->inventoryid))->update([
                'totalimport' =>$totalimport,
                'totalexport' =>$totalexport
            ]);
            
        }
        $inventorys =DB::table('inventory')
        ->join('product','product.productid','=','inventory.inventoryproduct_id')
        ->get();
        return view('inventory.index')->with([
            'inventory'=>$inventorys,
        ]);
    }
    
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $product = DB::table('product')->where('productname', 'LIKE', '%' . $request->search . '%')->get();
            if($product){
                foreach($product as $key=> $product){
                    $inventory = DB::table('inventory')->where('inventoryproduct_id',intval($product->productid))->get();
                    if ($inventory) {
                        foreach ($inventory as $key => $inventory) {
                            $output .= '<tr>
                            <td>' . $product->productname . '</td>
                            <td>' . $inventory->inventoryinstock . '</td>
                            <td>' . $inventory->inventoryquanlity_of_import . '</td>
                            <td>' . $inventory->inventoryquanlity_of_export . '</td>
                            <td>' . $inventory->totalimport . '</td>
                            <td>' . $inventory->totalexport . '</td>
                            </tr>';
                        }
                    }
                }
                
            
            
            }
            
            return Response($output);
           
        }
    }
    public function inventory(){
        $inventory = DB::table('inventory')
        ->join('product','product.productid','=','inventory.inventoryproduct_id')
        ->get();
        foreach($inventory as $key=> $inventory){
            $totalimport = DB::table('detailimport')->select('detailimportamount')
            ->where('detailimportproduct_id',$inventory->inventoryproduct_id)
            ->sum('detailimportquantity');
            $totalexport = DB::table('detailexport')->where('detailexportproduct_id',$inventory->inventoryproduct_id)
            ->sum('detailexportquantity');
            DB::table('inventory')->where('inventoryid',intval($inventory->inventoryid))->update([
                'totalimport' =>$totalimport,
                'totalexport' =>$totalexport
            ]);
            
        }
        $inventorys =DB::table('inventory')
        ->join('product','product.productid','=','inventory.inventoryproduct_id')
        ->get();
        return view('admin.inventory')->with([
            'inventory'=>$inventorys,
        ]);
    }
    public function update($id){    
        $inventory = DB::table('inventory')->where('inventoryid',$id)
        ->join('product',function($join){
            $join->on('product.productid','=','inventory.inventoryproduct_id');
            
        })
        ->first();
        // dd($inventory);
        return view('inventory.update')->with([
            'inventory'=>$inventory
        ]);
    }
    public function postUpdate(Request $request,$id){
        $instock = $request->input('txtinstock');
        $import = $request->input('txtimport');
        $export = $request->input('txtexport');
        DB::table('inventory')->where('inventoryid',intval($id))->update([
            'inventoryinstock' => intval($instock),
            'inventoryquanlity_of_import' => intval($import),
            'inventoryquanlity_of_export' => intval($export)
        ]);
        return redirect()->action('ReportController@inventory');
    }
    public function import(){
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
        
        return view('report.graph')->with([
            'totalemp'=>$totalemp,
            'totalpro'=>$totalpro,
            'totalimp' => $totalimp,
            'totalexp' => $totalexp,
            'dateimport'=>$datimport,
            'valueimport'=>$valuesimport,
            'valueexport'=>$valuesexport
        ]);

    }
    
    
}
