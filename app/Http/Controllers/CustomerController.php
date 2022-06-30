<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Marketer;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = Customer::where('name', $fields['name'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad cred',
            ], 401);
        }
        $token = $user->createToken('myKeys')->plainTextToken;
        $responce = [
            'user' => $user,
            'token' => $token
        ];
        return response($responce, 201);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->paginate(50);
        // $customers = Customer::all();    
        return view('pages.customer.customers_list')->with('customers', $customers);
    }
    public function indexApi()
    {
        $customer = Customer::all();
        // $token=$customer->createtok
        return response($customer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.customer.customer_create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:customers'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
            'phone' => ['required', 'numeric'],
            'available_balance' => ['numeric', 'nullable'],
            'country_code' => ['required', 'numeric'],
            'marketer_code' => ['numeric', 'nullable'],
            'profile_image' => ['image', 'max:2048', 'nullable']
            // password_confirmation field
        ]);
        $user = new Customer;
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->password = Hash::make($fields['password']);
        $user->phone = $fields['phone'];
        $user->country_code = $fields['country_code'];
        if (isset($fields['available_balance']))
            $user->available_balance = $fields['available_balance'];
        if (isset($fields['marketer_code']))
            $user->marketer_code = $fields['marketer_code'];
        if ($request->hasFile('profile_image')) {
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('cust_images'), $imageName);
            $user->profile_image = $imageName;
        }
        $user->save();

        return back()
            ->with('success', 'You have successfully add new customer.');
        // return redirect('customers_list/create')->with('success', 'new customer created');
    }
    public function storeApi(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:customers'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
            'phone' => ['required', 'numeric'],
            'available_balance' => ['numeric', 'nullable'],
            'country_code' => ['required', 'numeric'],
            'marketer_code' => ['numeric', 'nullable'],
            'profile_image' => ['image', 'max:2048', 'nullable']
            // password_confirmation field
        ]);
        $user = new Customer;
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->password = Hash::make($fields['password']);
        $user->phone = $fields['phone'];
        $user->country_code = $fields['country_code'];
        if (isset($fields['available_balance']))
            $user->available_balance = $fields['available_balance'];
        if (isset($fields['marketer_code']))
            $user->marketer_code = $fields['marketer_code'];
        if ($request->hasFile('profile_image')) {
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('cust_images'), $imageName);
            $user->profile_image = $imageName;
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
        $customer = Customer::findOrFail($id);
        // dd($customers->marketer);
        return view('pages.customer.customer')->with('customer', $customer);
        // return Customer::find($id);
    }

    public function showApi($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->makeHidden('image');
            $image = public_path('cust_images') . '\\' . Customer::find($id)->profile_image;
            $image = str_replace('\\', '/', $image);
            $data['image'] = $image;
            return collect($customer)->merge($data);
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
        $customer = Customer::find($id);
        return view('pages.customer.customer_edit')->with('customer', $customer);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email',  Rule::unique('customers', 'email')
                ->ignore($id)],
            'phone' => ['required', 'numeric'],
            'available_balance' => ['numeric', 'nullable'],
            'country_code' => ['required', 'numeric'],
            'marketer_code' => ['numeric', 'nullable'],
            'profile_image' => ['image', 'max:2048', 'nullable']
            // password_confirmation field
        ]);
        $customer = Customer::find($id);
        if (isset($fields['name']))
            $customer->name =  $fields['name'];
        if (isset($fields['email']))
            $customer->email =  $fields['email'];
        if (isset($fields['phone']))
            $customer->phone =  $fields['phone'];
        if (isset($fields['available_balance']))
            $customer->available_balance =  $fields['available_balance'];
        if (isset($fields['country_code']))
            $customer->country_code =   $fields['country_code'];
        if (isset($fields['marketer_code']))
            $customer->marketer_code =   $fields['marketer_code'];
        if ($request->hasFile('profile_image')) {
            if (isset($customer->profile_image)) {
                $path = public_path() . "/cust_images/" . $customer->profile_image;
                unlink($path);
            }
            $imageName = $request->name . $request->id . "_" . date('hs');
            $request->profile_image->move(public_path('cust_images'), $imageName);
            // $path = $request->profile_image->storeAs('images', $imageName);
            $customer->profile_image =   $imageName;
        }
        $customer->save();
        return back()
            ->with('success', 'You have successfully updated ' . $fields['name'] . ' customer.');
    }

    public function updateApi(Request $request, $id)
    {
        // return response("");
        $fields = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email',  Rule::unique('customers', 'email')
                ->ignore($id)],
            'phone' => ['numeric'],
            'available_balance' => ['numeric'],
            'country_code' => ['numeric'],
            'marketer_code' => ['numeric'],
            'profile_image' => ['image', 'max:2048']
            // password_confirmation field
        ]);
        $customer = Customer::find($id);
        if (isset($customer)) {
            if (isset($fields['name']))
                $customer->name =  $fields['name'];
            if (isset($fields['email']))
                $customer->email =  $fields['email'];
            if (isset($fields['phone']))
                $customer->phone =  $fields['phone'];
            if (isset($fields['available_balance']))
                $customer->available_balance =  $fields['available_balance'];
            if (isset($fields['country_code']))
                $customer->country_code =   $fields['country_code'];
            if (isset($fields['marketer_code']))
                $customer->marketer_code =   $fields['marketer_code'];
            if ($request->hasFile('profile_image')) {
                if (isset($customer->profile_image)) {
                    $path = public_path() . "/cust_images/" . $customer->profile_image;
                    unlink($path);
                }
                $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
                $request->profile_image->move(public_path('cust_images'), $imageName);
                // $path = $request->profile_image->storeAs('images', $imageName);
                $customer->profile_image =   $imageName;
            }
            $customer->update();
            return $customer;
        } else
            return response("no customer with that id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (isset($customer->profile_image)) {
            $path = public_path() . "/cust_images/" . $customer->profile_image;
            unlink($path);
        }
        Customer::destroy($id);
        return back()
            ->with('success', 'Customer have been deleted ');
    }
    public function destroyApi($id)
    {
        $customer = Customer::find($id);
        if ($customer)
            Customer::destroy($id);
        else
            return response("not found");
        // return response($id);
        return response('success');
    }
    public function search($name)
    {
        return Customer::where('name', 'like', '%' . $name . '%')->get();
    }
}
