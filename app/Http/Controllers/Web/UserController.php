<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('user/index', [
            'data' => $this->getList($request)
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return Inertia::render('user/form', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        User::create($request->all());

        return to_route('user.index');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'password' => ''
        ];
        if ($request->password) {
            $rules['password'] = 'min:8';
        }
        $request->validate($rules);

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->withErrors(['name' => 'Data pengguna tidak ditemukan']);
        }

        $request->merge([
            'password' => $request->password ? Hash::make($request->password) : $user->password
        ]);

        $user->update($request->all());

        return to_route('user.index');
    }

    public function create()
    {
        return Inertia::render('user/form');
    }

    public function show($id)
    {
        $user = User::find($id);
        return Inertia::render('user/form', [
            'user' => $user,
            'readonly' => true
        ]);
    }

    public function getList(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $page  = $request->page ? $request->page : 1;

        $data = User::query();

        if ($request->search) {
            $data->whereLike($request->search, ['name', 'email']);
        }

        return $data->paginate($limit, ['*'], 'page', $page);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return to_route('user.index');
    }
}
