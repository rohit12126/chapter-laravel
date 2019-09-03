<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreProductRequest;
use App\Product;
use DataTables;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
 
class ProductController extends Controller
{
    public function index()
    {
        if (! Gate::allows('products')) {
            return abort(401);
        }
        
        return view('admin.products.index');
    }

    public function getProductsData(){
        $filter = (!empty($_GET["filter_value"])) ? ($_GET["filter_value"]) : ('');
        if(!empty($filter)){
            $products = Product::query();
            $products->whereRaw("products.in_stock = '" . $filter . "'");
            $products->orderBy('products.id', 'DESC');
        }else{
            $products = Product::query();
            $products->orderBy('products.id', 'DESC');
        }
        return \DataTables::of($products)
            ->addIndexColumn()
            ->make(true);
    }

    public function create() {
        return view('admin.products.add_product');
    }


    public function store(StoreProductRequest $request){
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->save();

        return redirect()->route('admin.products.index');
    }
    /**/

}
