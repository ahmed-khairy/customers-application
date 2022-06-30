<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(50);
        // $customers = Customer::all();    
        return view('pages.product.products_list')->with('products', $products);
    }

    public function indexApi()
    {
        $product = Product::all();
        // $token=$customer->createtok
        return response($product);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product.product_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'customer_id' => ['required', 'numeric', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'images.*' => ['mimes:jpeg,png,jpg,gif,svg'],
            'description' => ['required', 'string', 'max:500'],
            'cost' => ['required', 'numeric'],
            'wholeSaleCost' => ['numeric', 'nullable'],
            'height' => ['required', 'numeric'],
            'width' => ['required', 'numeric'],
            'length' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            // password_confirmation field
        ]);
        // return response( $request->images[1]->getClientOriginalName());

        $user = new Product();
        $user->customer_id = $fields['customer_id'];
        $user->title = $fields['title'];
        $user->description = $fields['description'];
        $user->cost = $fields['cost'];
        $user->height = $fields['height'];
        $user->width = $fields['width'];
        $user->length = $fields['length'];
        $user->weight = $fields['weight'];
        if (isset($fields['wholeSaleCost']))
            $user->wholeSaleCost = $fields['wholeSaleCost'];
        if ($request->hasFile('images')) {
            $data = [];
            foreach ($fields['images'] as $key => $image) {
                $imageName = $request->name . $request->id . "_" . date('hs') . $key . '.' . $image->getClientOriginalExtension();
                // dd($image->getClientOriginalExtension());
                $request->images[$key]->move(public_path('prod_images'), $imageName);
                $data[] = $imageName;
                // $user->images[$key] = $imageName;
            }
            $stringData = json_encode($data);
            $user->images = $stringData;
        }
        $user->save();
        return back()
            ->with('success', 'You have successfully add new product.');
    }
    public function storeApi(Request $request)
    {
        $fields = $request->validate([
            'customer_id' => ['required', 'numeric', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'images.*' => ['mimes:jpeg,png,jpg,gif,svg'],
            'description' => ['required', 'string', 'max:500'],
            'cost' => ['required', 'numeric'],
            'wholeSaleCost' => ['numeric', 'nullable'],
            'height' => ['required', 'numeric'],
            'width' => ['required', 'numeric'],
            'length' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            // password_confirmation field
        ]);
        $user = new Product();
        $user->customer_id = $fields['customer_id'];
        $user->title = $fields['title'];
        $user->description = $fields['description'];
        $user->cost = $fields['cost'];
        $user->height = $fields['height'];
        $user->width = $fields['width'];
        $user->length = $fields['length'];
        $user->weight = $fields['weight'];
        $user->weight = $fields['weight'];
        if (isset($fields['wholeSaleCost']))
            $user->wholeSaleCost = $fields['wholeSaleCost'];
        if ($request->hasFile('images')) {
            $data = [];
            foreach ($fields['images'] as $key => $image) {
                $imageName = $request->name . $request->id . "_" . date('hs') . $key . '.' . $image->getClientOriginalExtension();
                $request->images[$key]->move(public_path('prod_images'), $imageName);
                $data[] = $imageName;
                // $user->images[$key] = $imageName;
            }
            $stringData = json_encode($data);
            $user->images = $stringData;
        }
        $user->save();
        $token = $user->createToken('myKeys')->plainTextToken;
        $responce = [
            'user' => $user,
            'token' => $token
        ];
        return response($responce, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('pages.product.product')->with('product', $product);
    }

    public function showApi($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->makeHidden('images', 'customer_id');
            $data['customer'] = $product->customer->name;
            foreach (json_decode($product->images) as $key => $item) {
                $image1 = public_path() . "/prod_images/" . $item;
                $image2[] = str_replace('\\', '/', $image1);
            }
            $data['image'] = $image2;
            return collect($product)->merge($data);
        } else
            return response("not found");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('pages.product.product_edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'customer_id' => ['required', 'numeric', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'images.*' => ['mimes:jpeg,png,jpg,gif,svg'],
            'description' => ['required', 'string', 'max:500'],
            'cost' => ['required', 'numeric'],
            'wholeSaleCost' => ['numeric', 'nullable'],
            'height' => ['required', 'numeric'],
            'width' => ['required', 'numeric'],
            'length' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            // password_confirmation field
        ]);
        $user = Product::find($id);
        // return $fields;
        if (isset($fields['customer_id']))
            $user->customer_id = $fields['customer_id'];
        if (isset($fields['title']))
            $user->title = $fields['title'];
        if (isset($fields['description']))
            $user->description = $fields['description'];
        if (isset($fields['cost']))
            $user->cost = $fields['cost'];
        if (isset($fields['height']))
            $user->height = $fields['height'];
        if (isset($fields['width']))
            $user->width = $fields['width'];
        if (isset($fields['length']))
            $user->length = $fields['length'];
        if (isset($fields['weight']))
            $user->weight = $fields['weight'];
        if (isset($fields['wholeSaleCost']))
            $user->wholeSaleCost = $fields['wholeSaleCost'];
        if ($request->hasFile('images')) {
            if (isset($user->images)) {
                foreach (json_decode($user->images) as $item) {
                    $path = public_path() . "/prod_images/" . $item;
                    unlink($path);
                }
            }
            $data = [];
            foreach ($fields['images'] as $key => $image) {
                $imageName = $request->name . $request->id . "_" . date('hs') . $key . '.' . $image->getClientOriginalExtension();
                $request->images[$key]->move(public_path('prod_images'), $imageName);
                $data[] = $imageName;
                // $user->images[$key] = $imageName;
            }
            $stringData = json_encode($data);
            $user->images = $stringData;
        }
        // return $user;
        $user->save();
        return back()
            ->with('success', 'You have successfully updated ' . $fields['title'] . ' product.');
    }
    public function updateApi(Request $request, $id)
    {
        // return response("");
        $fields = $request->validate([
            'customer_id' => ['numeric', 'max:255'],
            'title' => ['string', 'max:255'],
            'images.*' => ['mimes:jpeg,png,jpg,gif,svg'],
            'description' => ['string', 'max:500'],
            'cost' => ['numeric'],
            'wholeSaleCost' => ['numeric', 'nullable'],
            'height' => ['numeric'],
            'width' => ['numeric'],
            'length' => ['numeric'],
            'weight' => ['numeric'],
            // password_confirmation field
        ]);
        $user = Product::find($id);
        if (isset($user)) {
            if (isset($fields['customer_id']))
                $user->customer_id = $fields['customer_id'];
            if (isset($fields['title']))
                $user->title = $fields['title'];
            if (isset($fields['description']))
                $user->description = $fields['description'];
            if (isset($fields['cost']))
                $user->cost = $fields['cost'];
            if (isset($fields['height']))
                $user->height = $fields['height'];
            if (isset($fields['width']))
                $user->width = $fields['width'];
            if (isset($fields['length']))
                $user->length = $fields['length'];
            if (isset($fields['weight']))
                $user->weight = $fields['weight'];
            if (isset($fields['wholeSaleCost']))
                $user->wholeSaleCost = $fields['wholeSaleCost'];
            if ($request->hasFile('images')) {
                if (isset($user->images)) {
                    foreach (json_decode($user->images) as $item) {
                        $path = public_path() . "/prod_images/" . $item;
                        unlink($path);
                    }
                }
                $data = [];
                foreach ($fields['images'] as $key => $image) {
                    $imageName = $request->name . $request->id . "_" . date('hs') . $key . '.' . $image->getClientOriginalExtension();
                    $request->images[$key]->move(public_path('prod_images'), $imageName);
                    $data[] = $imageName;
                    // $user->images[$key] = $imageName;
                }
                $stringData = json_encode($data);
                $user->images = $stringData;
            }
            $user->update();
            return $user;
        } else
            return response("no product with that id");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (isset($product->images)) {
            foreach (json_decode($product->images) as $item) {
                $path = public_path() . "/prod_images/" . $item;
                unlink($path);
            }
        }
        Product::destroy($id);
        return back()
            ->with('success', 'Product has been deleted ');
    }
    public function destroyApi($id)
    {
        $product = Product::find($id);
        if ($product)
            Product::destroy($id);
        else
            return response("not found");
        // return response($id);
        return response('success');
    }
    public function search($name)
    {
        return Product::where('name', 'like', '%' . $name . '%')->get();
    }
}
