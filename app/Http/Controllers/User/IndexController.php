<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Worker;
use App\Models\User;
use App\Models\Role;
use App\Models\Source;
use App\Models\Status;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Cookie;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {

    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request) {
        return view('user.index');
    }

    public function index(Request $request) {
        //доступ всем кроме пользователей
        if (Auth::user()->role_id == 2)
            return redirect()
                ->route('welcome')
                ->withErrors(__('site.access_denied'));
        //фильтрация
        $statuses = Status::all();
        $skills = Skill::all();

        $filter = [];
        $fname = false;
        $fskills = false;
        $data = $request->all();
        if (isset($data['name']) && $data['name'] != '') {
            $filter['name'] = $data['name'];
            $fname = $filter['name'];
        }
        if (isset($data['status']) && $data['status']) {
            $filter['status'] = $data['status'];
        }
        if (isset($data['skills']) && !empty($data['skills'])) {
            $filter['skills'] = $data['skills'];
            $fskills = $filter['skills'];
        }
        if (empty($filter)) {
            $filter['status'] = 1;
        }
        //запрос
        $workers = DB::table('users')
            ->select('users.id', 'users.name', 'users.name_en', 'users.email', 'users.created_at', 'roles.name as role', 'statuses.name as status', 'workers.skills')
            ->join('workers', 'users.id', '=', 'workers.user_id')
            ->join('statuses', 'workers.status_id', '=', 'statuses.id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('workers.status_id', '=', $filter['status'])
            ->when($fname, function ($query, $fname) {
                return $query->where('users.name', 'like', "%" . $fname . "%")->orWhere('users.email', 'like', '%' . $fname . '%');
            })
            ->when($fskills, function ($query, $fskills) {
                if (!empty($fskills)) {
                    foreach ($fskills as $fskill) {
                        //$query->whereIn($fskill, 'workers.skills');
                        $query->whereRaw('FIND_IN_SET("'.$fskill.'", workers.skills)');
                    }
                }
                //dd($query);
                return $query;
            })
            ->get();

        //dd($workers);

        return view('user.workers', compact('workers', 'statuses', 'skills', 'filter'));
    }

    public function show($id)
    {
        //
    }

    public function create() {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors(__('site.access_denied'));
        $worker = new Worker();
        $roles = Role::all();
        $statuses = Status::all();
        $sources = Source::all();
        $skills = Skill::all();
        return view('user.create', compact('worker', 'roles', 'statuses', 'sources', 'skills'));
    }

    public function store(Request $request)
    {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors(__('site.access_denied'));
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "role_id" => $request->role_id
        ]);

        $data = $request->all();
        $data['user_id'] = $user->id;

        if ($image = $request->file('photo')) {
            //$name = $image->getClientOriginalName();
            $path = $image->store('public/images');
            //$photo = $image->move(storage_path('images'), time().'_'.$image->getClientOriginalName());
            $data['photo'] = str_replace('public/', '', $path);
        }

        $worker = new Worker();
        if ($worker->saveWorker($data)) {

            return redirect()
                ->route('user.index')
                ->with('success', __('site.add_user_success'));
        }

        return redirect()->route('user.index')->withErrors(__('site.add_user_error'));
    }

    public function destroy(User $user) {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors(__('site.access_denied'));
        $user->delete();
        return redirect()->route('user.index')
            ->with('success', __('site.delete_user_success'));
    }

    public function edit(User $user) {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors(__('site.access_denied'));
        $worker = $user;
        $roles = Role::all();
        $statuses = Status::all();
        $sources = Source::all();
        $skills = Skill::all();
        return view('user.edit', compact('worker', 'roles', 'statuses', 'sources', 'skills'));
    }

    public function update(Request $request, User $user) {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors(__('site.access_denied'));
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required',
            'status_id' => 'required',
        ]);
        $data = $request->all();
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);

        if ($image = $request->file('photo')) {
            //$name = $image->getClientOriginalName();
            $path = $image->store('public/images');
            //$photo = $image->move(storage_path('images'), time().'_'.$image->getClientOriginalName());
            $data['photo'] = str_replace('public/', '', $path);
        }

        $data['id'] = $user->worker->id;
        $data['user_id'] = $user->id;
        $worker = new Worker();
        if ($worker->updateWorker($data)) {

            if (isset($data['label']) && isset($data['value']) && !empty($data['label']) && !empty($data['value'])) {
                foreach ($data['label'] as $key => $field) {
                    $data = [
                        'id' => $key,
                        'worker_id' => $user->worker->id,
                        'label' => $field,
                        'value' => (isset($data['value'][$key]) && $data['value'][$key]) ? $data['value'][$key] : null
                    ];
                    $field = new Field();
                    $field->updateField($data);
                }
            }



            return redirect()->route('user.edit', $user->id)
                ->with('success', __('site.update_user_success'));

        }

        return redirect()->route('user.index')->withErrors(__('site.update_user_error'));
    }
}
