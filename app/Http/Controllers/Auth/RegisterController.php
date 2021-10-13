<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Source;
use App\Models\Status;
use App\Models\Skill;
use Hash;

class RegisterController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Форма регистрации
     */
    public function register(Request $request) {
        $data = $request->all();
        if (!isset($data['token']) || !$data['token'])
            return redirect()
                ->route('login')
                ->withErrors('Не передан токен');

        //сделать проверку токена

        $worker = new Worker();
        $roles = Role::all();
        $statuses = Status::all();
        $sources = Source::all();
        $skills = Skill::all();
        return view('user.create', compact('worker', 'roles', 'statuses', 'sources', 'skills'));
    }

    /**
     * Добавление пользователя
     */
    public function create(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['status_id'] = 1;

        $worker = new Worker();
        if ($worker->saveWorker($data)) {
            return redirect()
                ->route('login')
                ->with('success', 'Вы успешно зарегистрировались');
        }

        return redirect()
            ->route('login')
            ->withErrors('Ошибка регистрации');

    }
}
