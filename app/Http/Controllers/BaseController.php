<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected function setService($class) {
        $this->middleware(function ($request, $next) use($class){
            // $class->setAuthId(auth()->user());//new $repo(Auth::user());
            $class->setAuthId(Auth::id());//new $repo(Auth::user());
            return $next($request);
        });
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSuccess($message, $status = 200, $data = null)
    {
        return response()->json(['message' => $message, 'data' => $data], $status);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($message, $code = 404, $errors = null)
    {
        return response()->json(['message' => $message, 'errors' => $errors], $code);
    }
}
