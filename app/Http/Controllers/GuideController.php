<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }


    public function index() {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав');
        $guids = [];
        $items = DB::table('roles')->get();
        $guids[] = ['name' => 'Роли', 'table' => 'roles', 'items' => $items];
        $items = DB::table('statuses')->get();
        $guids[] = ['name' => 'Статусы', 'table' => 'statuses', 'items' => $items];
        $items = DB::table('sources')->get();
        $guids[] = ['name' => 'Источники', 'table' => 'sources', 'items' => $items];
        $items = DB::table('skills')->get();
        $guids[] = ['name' => 'Навыки', 'table' => 'skills', 'items' => $items];
        return view('guide.index', compact('guids'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function status()
    {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для удаления сотрудников');
        $guids = [];
        $items = DB::table('roles')->get();
        $guids[] = ['name' => 'Роли', 'table' => 'roles', 'items' => $items];
        $items = DB::table('statuses')->get();
        $guids[] = ['name' => 'Статусы', 'table' => 'statuses', 'items' => $items];
        $items = DB::table('sources')->get();
        $guids[] = ['name' => 'Источники', 'table' => 'sources', 'items' => $items];
        $items = DB::table('skills')->get();
        $guids[] = ['name' => 'Навыки', 'table' => 'skills', 'items' => $items];
        return view('guide.index', compact('guids'));
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function source()
    {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для удаления сотрудников');
        $items = DB::table('sources')->get();
        $guide = ['name' => 'Источники', 'table' => 'sources'];
        return view('guide.index', compact('items', 'guide'));
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function role()
    {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для удаления сотрудников');
        $items = DB::table('roles')->get();
        $guide = ['name' => 'Роли', 'table' => 'roles'];
        return view('guide.index', compact('items', 'guide'));
    }*/

    /*public function skill()
    {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для удаления сотрудников');
        $items = DB::table('skills')->get();
        $guide = ['name' => 'Навыки', 'table' => 'skills'];
        return view('guide.index', compact('items', 'guide'));
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для удаления сотрудников');
        $data = $request->all();
        if (!$data['table'] || !$data['name'])
            return redirect()->route('welcome')->withErrors('Не переданы параметры');
        $table = trim(strip_tags($data['table']));
        $result = DB::table($table)->insert(['name' => trim(strip_tags($data['name']))]);
        if (!$result)
            return redirect()->route('guide')->withErrors('Не удалось добавить значение');
        return redirect()->route('guide')->with('success','Значение успешно добавлено');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для удаления сотрудников');
        $data = $request->all();
        if (!$data['table'] || !$data['name'] || !$data['id'])
            return redirect()->route('welcome')->withErrors('Не переданы параметры');
        $table = trim(strip_tags($data['table']));
        $result = DB::table($table)->where('id', intval($data['id']))->update(['name' => trim(strip_tags($data['name']))]);
        if (!$result)
            return redirect()->route('guide')->withErrors('Не удалось обновить значение');
        return redirect()->route('guide')->with('success','Значение успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //доступ админам
        if (Auth::user()->role_id !== 1)
            return redirect()
                ->route('welcome')
                ->withErrors('Не достаточно прав для удаления сотрудников');
        $data = $request->all();
        if (!$data['table'] || !$data['id'])
            return redirect()->route('welcome')->withErrors('Не переданы параметры');
        $table = trim(strip_tags($data['table']));
        //сделать валидатор
        if ($table == 'statuses') {
            $useStatus = DB::table('workers')->where('status_id', intval($data['id']))->count();
            if ($useStatus)
                return redirect()->route('guide')->withErrors('Нельзя удалить значение, выбранное у кандидатов');
        }
        $result = DB::table($table)->where('id', intval($data['id']))->delete();
        if (!$result)
            return redirect()->route('guide')->withErrors('Не удалось удалить значение');
        return redirect()->route('guide')->with('success','Значение успешно удалено');
    }
}
