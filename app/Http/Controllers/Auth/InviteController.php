<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Status;
use App\Models\User;
use App\Models\Worker;

class InviteController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Форма ввода адреса почты
     */
    public function form() {
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для приглашения сотрудников');
        return view('auth.invite');
    }

    /**
     * Письмо на почту для регистрации
     */
    public function mail(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);
        $token = Str::random(60);
        /*
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        */

        $user = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'password' => null,
            'role_id' => 2
        ]);

        $worker = new Worker();
        $worker->user_id = $user->id;
        $worker->status_id = Status::getDefaultStatus();
        if (!$worker->save()) {
            return redirect()
                ->route('login')
                ->withErrors('Ошибка регистрации');
        }

        // ссылка для сброса пароля
        $link = route('register', ['token' => $token, 'email' => $request->email]);
        Mail::send(
            'email.invite',
            ['link' => $link],
            function($message) use ($request) {
                $message->to($request->email);
                $message->subject('Приглашение на регистрацию');
            }
        );

        return back()->with('success', 'Ссылка для регистрации пользователя отправлена на почту');
    }
}
