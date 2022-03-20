<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model; 

    public function __construct(User $user) 
    {
        $this->model = $user;
    }

    public function index(Request $request) //$request = new Request
    {
        //1ºforma //$users = User::where('name', 'LIKE', "%{$request->search}%")->get();
        $search = $request->search;
        $users = $this->model
                        ->getUsers(
                            search: $request->search ?? ''
                    );
        //dd($users);
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        //$user = User::where('id', $id)->first();
        if (!$user = $this->model->find($id))
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
        $this->model->create($data);

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
        if (!$user = $this->model->find($id))
            return redirect()->route('users.index');
        
        return view('users.edit', compact('user')); 
        // dd('users.edit', $id);
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        if (!$user = $this->model->find($id))
            return redirect()->route('users.index');
        
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
        if (!$user = $this->model->find($id))
            return redirect()->route('users.index');
        
        $user->delete();
        
        return redirect()->route('users.index');

        // dd('users.show', $id);
    }
}
