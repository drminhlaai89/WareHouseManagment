<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CatalogController extends Controller
{
     public function index(){
         $cat = DB::table('productcatalog')->get();
         return view('catalog.index')->with([
             "cat" => $cat
         ]);
    }

    public function detail($id){
        $cat = DB::table('productcatalog')->where('productcatalogid',intval($id))->first();
        return view('catalog.detail')->with([
            'cat'=>$cat
        ]);
    }
     public function create(){
         return view('Catalog.create');
     }
     public function postCreate(Request $request){
         $name=$request->input('txtname');
         $description = $request->input('txtdes');
         $image = $request->input('txtimage');
         $createddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
         $createdby = session()->get('user')->username;
         DB::table('productcatalog')->insert([
             'productcatalogname' =>$name,
             'productcatalogdescription'=>$description,
             'productcatalogimage'=>$image,
             'productcatalogcreateddate'=>$createddate,
             'productcatalogcreatedby'=>$createdby
         ]);
         return redirect()->action('CatalogController@index');
     }
     public function update($id){
         $cat=DB::table('productcatalog')->where('productcatalogid',intval($id))->first();
         return view('Catalog.update')->with([
             'id'=>$id,
             'cat'=>$cat
         ]);
     }
     public function postUpdate(Request $request, $id){
         $name=$request->input('txtname');
         $description = $request->input('txtdes');
         $image = $request->input('txtimage');
         $modifieddate = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
         $modifiedby = session()->get('user')->username;
         DB::table('productcatalog')->where('productcatalogid',intval($id))->update([
             'productcatalogname' =>$name,
             'productcatalogdescription'=>$description,
             'productcatalogimage'=>$image,
             'productcatalogmodifieddate'=>$modifieddate,
             'productcatalogmodifiedby'=>$modifiedby
         ]);
         return redirect()->action('CatalogController@index');
     }

     public function searchCatalog(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $catalogs = DB::table('productcatalog')
            ->where('productcatalogname', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($catalogs) {
                foreach ($catalogs as $key => $catalog) {
                    $output .= '<tr>
                    <td>' . $catalog->productcatalogid . '</td>
                    <td><strong>' . $catalog->productcatalogname . '</strong></td>
                    <td>' . $catalog->productcatalogdescription . '</td>
                    <td>' . '<img src="{{$catalog->productcatalogimage}}">' . '</td>
                    <td>
                    <a href="/catalog/detail/'.$catalog->productcatalogid.'" class="btn btn-info "><i class="mdi mdi-eye"></i></a>
                    <a href="/catalog/update/'.$catalog->productcatalogid.'" class="btn btn-primary"><i class="mdi mdi-account-edit"></i></a>
                    </td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
}