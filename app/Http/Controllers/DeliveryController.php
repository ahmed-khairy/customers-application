<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DeliveryController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = Delivery::where('name', $fields['name'])->first();

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
        $deliveries = Delivery::orderBy('created_at', 'desc')->paginate(50);
        // $customers = Customer::all();    
        return view('pages.delivery.deliveries_list')->with('deliveries', $deliveries);
    }
    public function indexApi()
    {
        $delivery = Delivery::all();
        // $token=$customer->createtok
        return response($delivery);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.delivery.delivery_create');
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
            'email' => ['required', 'string', 'email', 'unique:deliveries'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
            'phone' => ['required', 'numeric'],
            'available_balance' => ['numeric', 'nullable'],
            'profile_image' => ['image', 'max:2048', 'nullable'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'active' => ['required', 'boolean'],
            'busy' => ['required', 'boolean'],
            'map' => ['required', 'json'],

            // password_confirmation field
        ]);
        $user = new Delivery;
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->password = Hash::make($fields['password']);
        $user->phone = $fields['phone'];
        $user->latitude = $fields['latitude'];
        $user->longitude = $fields['longitude'];
        $user->active = $fields['active'];
        $user->busy = $fields['busy'];
        $user->map = $fields['map'];
        if (isset($fields['available_balance']))
            $user->available_balance = $fields['available_balance'];
        if ($request->hasFile('profile_image')) {
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('del_images'), $imageName);
            $user->profile_image = $imageName;
        }
        $user->save();

        return back()
            ->with('success', 'You have successfully add new delivery user.');
        // return redirect('customers_list/create')->with('success', 'new customer created');
    }
    public function storeApi(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:deliveries'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
            'phone' => ['required', 'numeric'],
            'available_balance' => ['required', 'numeric'],
            'profile_image' => ['image', 'max:2048'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'active' => ['required', 'boolean'],
            'busy' => ['required', 'boolean'],
            'map' => ['required', 'json'],
            // password_confirmation field
        ]);
        $user = new Delivery;
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->latitude = $fields['latitude'];
        $user->longitude = $fields['longitude'];
        $user->active = $fields['active'];
        $user->busy = $fields['busy'];
        $user->map = $fields['email'];
        $user->password = Hash::make($fields['password']);
        $user->phone = $fields['phone'];
        if (isset($fields['available_balance']))
            $user->available_balance = $fields['available_balance'];
        if ($request->hasFile('profile_image')) {
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('del_images'), $imageName);
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
        $delivery = Delivery::find($id);
        return view('pages.delivery.delivery')->with('delivery', $delivery);
    }
    public function showApi($id)
    {
        //    return Delivery::select('name','email')->where('id', $id)->get();
        $delivery = Delivery::find($id);
        if ($delivery) {
            $delivery->makeHidden('map', 'image');
            $image = public_path('del_images') . '\\' . Delivery::find($id)->profile_image;
            $image = str_replace('\\', '/', $image);
            $map = Delivery::find($id)->map;
            $data['image'] = $image;
            $data['map'] = json_decode($map);
            return collect($delivery)->merge($data);
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
        $delivery = Delivery::find($id);
        return view('pages.delivery.delivery_edit')->with('delivery', $delivery);
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
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email',  Rule::unique('deliveries', 'email')
                ->ignore($id)],
            'phone' => ['numeric'],
            'available_balance' => ['numeric', 'nullable'],
            'profile_image' => ['image', 'max:2048', 'nullable'],
            'latitude' => ['numeric'],
            'longitude' => ['numeric'],
            'active' => ['boolean'],
            'busy' => ['boolean'],
            'map' => ['json'],
            // password_confirmation field
        ]);
        $user = Delivery::find($id);
        if (isset($fields['name']))
            $user->name =  $fields['name'];
        if (isset($fields['email']))
            $user->email =  $fields['email'];
        if (isset($fields['phone']))
            $user->phone =  $fields['phone'];
        if (isset($fields['available_balance']))
            $user->available_balance =  $fields['available_balance'];
        if (isset($fields['latitude']))
            $user->latitude =  $fields['latitude'];
        if (isset($fields['longitude']))
            $user->longitude =  $fields['longitude'];
        if (isset($fields['active']))
            $user->active =  $fields['active'];
        if (isset($fields['busy']))
            $user->busy =  $fields['busy'];
        if (isset($fields['map']))
            $user->map =  $fields['map'];
        if ($request->hasFile('profile_image')) {
            if (isset($user->profile_image)) {
                $path = public_path() . "/del_images/" . $user->profile_image;
                unlink($path);
            }
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('del_images'), $imageName);
            // $path = $request->profile_image->storeAs('images', $imageName);
            $user->profile_image =   $imageName;
        }
        $user->save();
        return back()
            ->with('success', 'You have successfully updated ' . $fields['name'] . ' delivery user.');
    }
    public function updateApi(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email',  Rule::unique('deliveries', 'email')
                ->ignore($id)],
            'phone' => ['numeric'],
            'available_balance' => ['numeric'],
            'profile_image' => ['image', 'max:2048'],
            'latitude' => ['numeric'],
            'longitude' => ['numeric'],
            'active' => ['boolean'],
            'busy' => ['boolean'],
            'map' => ['json'],
            // password_confirmation field
        ]);
        $user = Delivery::find($id);
        if ($user) {

            if (isset($fields['name']))
                $user->name =  $fields['name'];
            if (isset($fields['email']))
                $user->email =  $fields['email'];
            if (isset($fields['phone']))
                $user->phone =  $fields['phone'];
            if (isset($fields['available_balance']))
                $user->available_balance =  $fields['available_balance'];
            if (isset($fields['latitude']))
                $user->latitude =  $fields['latitude'];
            if (isset($fields['longitude']))
                $user->longitude =  $fields['longitude'];
            if (isset($fields['active']))
                $user->active =  $fields['active'];
            if (isset($fields['busy']))
                $user->busy =  $fields['busy'];
            if (isset($fields['map']))
                $user->map =  $fields['map'];
            if ($request->hasFile('profile_image')) {
                if (isset($user->profile_image)) {
                    $path = public_path() . "/del_images/" . $user->profile_image;
                    unlink($path);
                }
                $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
                $request->profile_image->move(public_path('del_images'), $imageName);
                // $path = $request->profile_image->storeAs('images', $imageName);
                $user->profile_image =   $imageName;
            }
            $user->update();
            return $user;
        } else {
            return response("not found");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Delivery::find($id);
        if (isset($user->profile_image)) {
            $path = public_path() . "/del_images/" . $user->profile_image;
            unlink($path);
        }
        Delivery::destroy($id);
        return back()
            ->with('success', 'Delivery user have been deleted ');
    }
    public function destroyApi($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery)
            Delivery::destroy($id);
        else
            return response("not found");
        // return response($id);
        return response('success');
    }
    public function search($name)
    {
        return Delivery::where('name', 'like', '%' . $name . '%')->get();
    }
}
