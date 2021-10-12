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

class IndexController extends Controller {

    public function __construct() {
        $this->middleware('auth');
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
        if (Auth::user()->worker->right == Worker::getRight()[1])
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для просмотра сотрудников');
        //фильтрация
        $work = new Worker();
        if (isset($_COOKIE["filter"]))
            $filter = $_COOKIE["filter"];
        else
            $filter = Status::find(1)->id;
        $data = $request->all();
        if (isset($data['filter']) && $data['filter']) {
            setcookie ("filter", $data['filter'],time()+3600);
            $filter = $data['filter'];
        }

        $workers = User::with(['worker' => function ($query) use ($filter) {
            $query->where('workers.status_id', '=', $filter)->get();
        }])->get();

        dd($workers);

        //$workers = User::with('worker')->where('status_id', $filter)->get();
        /*
        $workers = [];
        if ($filter != '') {
            foreach ($allWorkers as $worker) {
                if ($worker->worker->status == $filter) {
                    $workers[] = $worker;
                }
            }
        }
        */
        return view('user.workers', compact('workers', 'work', 'filter'));
    }

    public function show($id)
    {
        //
    }

    public function create() {
        //доступ админам
        if (Auth::user()->worker->right !== Worker::getRight()[0])
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для создания сотрудников');
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
        if (Auth::user()->worker->right !== Worker::getRight()[0])
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для сохранения сотрудников');
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

        $worker = new Worker();
        if ($worker->saveWorker($data)) {

            return redirect()
                ->route('user.index')
                ->with('success','Сотрудник успешно добавлен');
        }

        return redirect()->route('user.index')->withErrors('Не удалось зарегистрировать сотрудника');
    }

    public function destroy(User $user) {
        //доступ админам
        if (Auth::user()->worker->right !== Worker::getRight()[0])
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для удаления сотрудников');
        $user->delete();
        return redirect()->route('user.index')
            ->with('success','Сотрудник успешно удален');
    }

    public function edit(User $user) {
        //доступ админам
        if (Auth::user()->worker->right !== Worker::getRight()[0])
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для редактирования сотрудников');
        $worker = new Worker();
        return view('user.edit', compact('user', 'worker'));
    }

    public function update(Request $request, User $user) {
        //доступ админам
        if (Auth::user()->worker->right !== Worker::getRight()[0])
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для обновления сотрудников');
        $request->validate([
            'name' => 'required',
            'right' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();

        $user->update($data);

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
                ->with('success', 'Сотрудник успешно обновлен');

        }

        return redirect()->route('user.index')->withErrors('Не удалось обновить сотрудника');
    }
}
