<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) //$request = new Request
    {
        //1ºforma //$users = User::where('name', 'LIKE', "%{$request->search}%")->get();
        $search = $request->search;
        $users = User::where(function ($query) use ($search) {
            if ($search) {
                $query->where('email', $search);
                $query->orWhere('name', 'LIKE', "%{$search}%");
            }
        })->get();
        //dd($users);
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        //$user = User::where('id', $id)->first();
        if (!$user = User::find($id))
            return redirect()->route('users.index');
          
        return view('users.show', compact('user'));

        // dd('users.show', $id);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        // User::create();
        $user = User::create($data);

        return redirect()->route('users.index');
        //return redirect()->route('users.show', $user->id);

        // dd($request->all());
        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();
    }

    public function edit($id)
    {
        if (!$user = User::find($id))
            return redirect()->route('users.index');
        
        return view('users.edit', compact('user')); 
        // dd('users.edit', $id);
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        if (!$user = User::find($id))
            return redirect()->route('users.index');
        
        // $user->name = $request->get('name');
        // $user->save();//forma manual não produtiva
        $data = $request->only('name', 'email');
        if ($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);
        
        return redirect()->route('users.index');
        // dd($request->all());
    }

    public function destroy($id)
    {
        //$user = User::where('id', $id)->first();
        if (!$user = User::find($id))
            return redirect()->route('users.index');
        
        $user->delete();
        
        return redirect()->route('users.index');

        // dd('users.show', $id);
    }
}
