<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class LocaleMiddleware
{
    public static $mainLanguage = 'ru'; //основной язык, который не должен отображаться в URl

    public static $languages = ['en', 'ru']; // Указываем, какие языки будем использовать в приложении.

    /*
 * Проверяет наличие корректной метки языка в текущем URL
 * Возвращает метку или значеие null, если нет метки
 */
    public static function getLocale()
    {
        $uri = url()->current(); //получаем URI

        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"

        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {

            if ($segmentsURI[0] != self::$mainLanguage) return $segmentsURI[0];

        }
        return null;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = self::getLocale();

        if($locale) App::setLocale($locale);
        //если метки нет - устанавливаем основной язык $mainLanguage
        else App::setLocale(self::$mainLanguage);
        return $next($request);
    }
}
