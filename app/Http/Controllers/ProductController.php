<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index() {
        $products = DB::table('product')->paginate(6);
        $catalogs = DB::table('productcatalog')->get();
        return view('product.index')->with([
            'products'=>$products,
            'catalogs'=>$catalogs,
        ]);
    }
    public function detail($id){
        $product = DB::table('product')->where('productid',intval($id))
        ->join('productcatalog','productcatalogid','=','productproductcatalog_id')->first();
        return view('product.detail')->with([
            'product'=>$product,
        ]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            // $products = DB::table('product')->where('productid', intval(1));
            $product = DB::table('product')->where('productname', 'LIKE', '%' . $request->search . '%')->get();
            if ($product) {
                foreach ($product as $key => $product) {
                 
                    $output .= '
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                        <a href="/product/detail/' . $product->productid . '">
                            <img class="card-img-top" src="'.$product->productimage.'">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                    <a href="/product/detail/'.$product->productid.'"</a>'.$product->productname.'</h4>
                    <h5>' . $product->productprice . '</h5>
                    <p class="card-text">' . $product->productdescription . '</p>
                        </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>';
                }
            }
            
            return Response($output);
        }
    }

    public function create(Request $request) {
        $catalog = DB::table('productcatalog')->get();
        return view('product.create')->with([
            'cat'=>$catalog,
        ]);
            
    }
    public function postCreate(Request $request) {
        $name = $request->input('txtName');
        $brand = $request->input('txtBrand');
        $price = intval($request->input('txtPrice'));
        $des = $request->input('txtdes');
        $image = $request->input('txtImage');
        $productcatalog_id = $request->input('catalog');
        $status = 1;
        $note = $request->input('txtNote');
        $createddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $createdby = session()->get('user')->username;
        $productid = DB::table('product')->insertGetId([
            'productname' => $name,
            'productbrand' =>$brand,
            'productprice'=>$price,
            'productdescription' =>$des,
            'productimage'=>$image,
            'productproductcatalog_id'=>$productcatalog_id,
            'productstatus' =>$status,
            'productnote' =>$note,
            'productcreateddate' =>$createddate,
            'productcreatedby' =>$createdby
        ]);
        DB::table('inventory')->insert([
            'inventoryproduct_id'=>$productid,
        ]);
        return redirect()->action('ProductController@index');
    }
    public function update(Request $request, $id){
        $product = DB::table('product')->where('productid',intval($id))->first();
        $catalog = DB::table('productcatalog')->get();
        
        return view('product.update')->with([
            'product'=>$product,
            'cat'=>$catalog
        ]);
    }
    public function postUpdate(Request $request, $id){
        $name = $request->input('txtName');
        $brand = $request->input('txtBrand');
        $price = intval($request->input('txtPrice'));
        $des = $request->input('txtdes');
        $image = $request->input('txtImage');
        $productcatalog_id = $request->input('catalog');
        $status = 1;
        $note = $request->input('txtNote');
        $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $modifiedby = session()->get('user')->username;
        DB::table('product')->where('productid',intval($id))->update([
            'productname' => $name,
            'productbrand' =>$brand,
            'productprice'=>$price,
            'productdescription' =>$des,
            'productimage'=>$image,
            'productproductcatalog_id'=>$productcatalog_id,
            'productstatus' =>$status,
            'productnote' =>$note,
            'productmodifieddate'=>$modifieddate,
            'productmodifiedby'=>$modifiedby
        ]);
        return redirect()->action('ProductController@index');
    }

    public function productType($id){
        $products = DB::table('product')->where('productproductcatalog_id',intval($id))
        ->join('productcatalog','productcatalogid','=','productproductcatalog_id')->paginate(6);
        return view('product.productType')->with([
            'products'=>$products,
        ]);
    }
}
