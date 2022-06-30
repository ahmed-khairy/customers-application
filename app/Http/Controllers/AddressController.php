<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::orderBy('created_at', 'desc')->paginate(50);
        // $customers = Customer::all();    
        return view('pages.address.addresses_list')->with('addresses', $addresses);
    }

    public function indexApi()
    {
        $addresses = Address::all();
        // $token=$customer->createtok
        return response($addresses);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.address.address_create');
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
            'title' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric',],
            'longitude' => ['required', 'numeric'],
            'customer_id' => ['required', 'numeric'],
            'address' => ['required', 'string']
            // password_confirmation field
        ]);
        $user = new Address();
        $user->title = $fields['title'];
        $user->phone = $fields['phone'];
        $user->latitude = $fields['latitude'];
        $user->longitude = $fields['longitude'];
        $user->customer_id = $fields['customer_id'];
        $user->address = $fields['address'];
        $user->save();

        return back()
            ->with('success', 'You have successfully add new address.');
        // return redirect('customers_list/create')->with('success', 'new customer created');
    }
    public function storeApi(Request $request)
    {
        $fields = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric',],
            'longitude' => ['required', 'numeric'],
            'customer_id' => ['required', 'numeric'],
            'address' => ['required', 'string']
            // password_confirmation field
        ]);
        $user = new Address();
        $user->title = $fields['title'];
        $user->phone = $fields['phone'];
        $user->latitude = $fields['latitude'];
        $user->longitude = $fields['longitude'];
        $user->customer_id = $fields['customer_id'];
        $user->address = $fields['address'];
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
        $address = Address::findOrFail($id);
        // dd($customers->marketer);
        return view('pages.address.address')->with('address', $address);
        // return Customer::find($id);
    }

    public function showApi($id)
    {
        $address = Address::findOrFail($id);
        if (isset($address))
            return Address::find($id);
        else
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
        $address = Address::find($id);
        return view('pages.address.address_edit')->with('address', $address);
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
            'title' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric',],
            'longitude' => ['required', 'numeric'],
            'customer_id' => ['required', 'numeric'],
            'address' => ['required', 'string']
            // password_confirmation field
        ]);
        $address = Address::find($id);
        if (isset($fields['title']))
            $address->title =  $fields['title'];
        if (isset($fields['phone']))
            $address->phone =  $fields['phone'];
        if (isset($fields['phone']))
            $address->phone =  $fields['phone'];
        if (isset($fields['latitude']))
            $address->latitude =  $fields['latitude'];
        if (isset($fields['longitude']))
            $address->longitude =   $fields['longitude'];
        if (isset($fields['customer_id']))
            $address->customer_id =   $fields['customer_id'];
        if (isset($fields['address']))
            $address->address =   $fields['address'];
        $address->update();
        return back()
            ->with('success', 'You have successfully updated ' . $fields['title'] . ' address.');
    }

    public function updateApi(Request $request, $id)
    {
        // return response("");
        $fields = $request->validate([
            'title' => ['string', 'max:255'],
            'phone' => ['numeric'],
            'latitude' => ['numeric',],
            'longitude' => ['numeric'],
            'customer_id' => ['numeric'],
            'address' => ['string']
            // password_confirmation field
        ]);
        $address = Address::find($id);
        if (isset($address)) {
            if (isset($fields['title']))
                $address->title =  $fields['title'];
            if (isset($fields['phone']))
                $address->phone =  $fields['phone'];
            if (isset($fields['phone']))
                $address->phone =  $fields['phone'];
            if (isset($fields['latitude']))
                $address->latitude =  $fields['latitude'];
            if (isset($fields['longitude']))
                $address->longitude =   $fields['longitude'];
            if (isset($fields['customer_id']))
                $address->customer_id =   $fields['customer_id'];
            if (isset($fields['address']))
                $address->address =   $fields['address'];
            $address->update();
            return $address;
        } else
            return response("no address with that id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        Address::destroy($id);
        return back()
            ->with('success', 'address have been deleted ');
    }
    public function destroyApi($id)
    {
        $address = Address::find($id);
        if (isset($address))
            Address::destroy($id);
        else
            return response("not found");
        // return response($id);
        return response('success');
    }
    public function search($name)
    {
        return address::where('name', 'like', '%' . $name . '%')->get();
    }
}
