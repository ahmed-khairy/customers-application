<?php

namespace App\Http\Controllers;

use App\Models\Marketer;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MarketerController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = Marketer::where('name', $fields['name'])->first();

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
        $marketers = Marketer::orderBy('created_at', 'desc')->paginate(50);
        // $customers = Customer::all();    
        return view('pages.marketer.marketers_list')->with('marketers', $marketers);
    }
    public function indexApi()
    {
        $marketer = Marketer::all();
        // $token=$customer->createtok
        return response($marketer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.marketer.marketer_create');
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
            'code' => ['required', 'numeric'],
            'profile_image' => ['image', 'max:2048', 'nullable']
            // password_confirmation field
        ]);
        $user = new Marketer();
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->password = Hash::make($fields['password']);
        $user->phone = $fields['phone'];
        $user->code = $fields['code'];
        if (isset($fields['available_balance']))
            $user->available_balance = $fields['available_balance'];
        if ($request->hasFile('profile_image')) {
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('mark_images'), $imageName);
            $user->profile_image = $imageName;
        }
        $user->save();

        return back()
            ->with('success', 'You have successfully add new marketer user.');
    }
    public function storeApi(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:customers'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
            'phone' => ['required', 'numeric'],
            'available_balance' => ['numeric',],
            'codde' => ['required', 'numeric'],
            'profile_image' => ['image', 'max:2048']
            // password_confirmation field
        ]);
        $user = new Marketer();
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->password = Hash::make($fields['password']);
        $user->phone = $fields['phone'];
        $user->code = $fields['code'];
        if (isset($fields['available_balance']))
            $user->available_balance = $fields['available_balance'];
        if ($request->hasFile('profile_image')) {
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('mark_images'), $imageName);
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
        $marketer = Marketer::find($id);
        return view('pages.marketer.marketer')->with('marketer', $marketer);
    }
    public function showApi($id)
    {
        $marketer = Marketer::find($id);
        if ($marketer) {
            $marketer->makeHidden('image');
            $image = public_path('mark_images') . '\\' . Marketer::find($id)->profile_image;
            $image = str_replace('\\', '/', $image);
            $data['image'] = $image;
            return collect($marketer)->merge($data);
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
        $marketer = Marketer::find($id);
        return view('pages.marketer.marketer_edit')->with('marketer', $marketer);
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
            'email' => ['string', 'email',  Rule::unique('customers', 'email')
                ->ignore($id)],
            'phone' => ['numeric'],
            'available_balance' => ['numeric', 'nullable'],
            'code' => ['numeric'],
            'profile_image' => ['image', 'max:2048', 'nullable']
            // password_confirmation field
        ]);
        $marketer = Marketer::find($id);
        if (isset($fields['name']))
            $marketer->name =  $fields['name'];
        if (isset($fields['email']))
            $marketer->email =  $fields['email'];
        if (isset($fields['phone']))
            $marketer->phone =  $fields['phone'];
        if (isset($fields['available_balance']))
            $marketer->available_balance =  $fields['available_balance'];
        if (isset($fields['country_code']))
            $marketer->code =   $fields['code'];
        if ($request->hasFile('profile_image')) {
            if (isset($marketer->profile_image)) {
                $path = public_path() . "/mark_images/" . $marketer->profile_image;
                unlink($path);
            }
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('mark_images'), $imageName);
            // $path = $request->profile_image->storeAs('images', $imageName);
            $marketer->profile_image =   $imageName;
        }
        $marketer->save();
        return back()
            ->with('success', 'You have successfully updated ' . $fields['name'] . ' marketer user.');
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
            'code' => ['numeric'],
            'profile_image' => ['image', 'max:2048']
            // password_confirmation field
        ]);
        $marketer = Marketer::find($id);
        if (isset($fields['name']))
            $marketer->name =  $fields['name'];
        if (isset($fields['email']))
            $marketer->email =  $fields['email'];
        if (isset($fields['phone']))
            $marketer->phone =  $fields['phone'];
        if (isset($fields['available_balance']))
            $marketer->available_balance =  $fields['available_balance'];
        if (isset($fields['country_code']))
            $marketer->code =   $fields['code'];
        if ($request->hasFile('profile_image')) {
            if (isset($marketer->profile_image)) {
                $path = public_path() . "/mark_images/" . $marketer->profile_image;
                unlink($path);
            }
            $imageName = $request->name . $request->id . "_" . date('hs') . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('mark_images'), $imageName);
            // $path = $request->profile_image->storeAs('images', $imageName);
            $marketer->profile_image =   $imageName;
        }
        $marketer->update();
        return $marketer;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marketer = Marketer::find($id);
        if (isset($marketer->profile_image)) {
            $path = public_path() . "/mark_images/" . $marketer->profile_image;
            unlink($path);
        }
        Marketer::destroy($id);
        return back()
            ->with('success', 'Marketer user have been deleted ');
    }
    public function destroyApi($id)
    {
        $marketer = Marketer::find($id);
        if ($marketer)
            Marketer::destroy($id);
        else
            return response("not found");
        // return response($id);
        return response('success');
    }
    public function search($name)
    {
        return Marketer::where('name', 'like', '%' . $name . '%')->get();
    }
}
