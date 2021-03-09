<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Models\Setting\Setting;
use App\Models\Setting\PageSetting;

class Handler extends ExceptionHandler
{
    // data profile setting
    public function setting()
    {
        return Setting::first();
    }

    // menu
    public function menu()
    {
        return [
            'room'         => PageSetting::where('page_code', 'Room')->get(),
            'recreation'   => PageSetting::where('page_code', 'Recreation')->get(),
            'spa'          => PageSetting::where('page_code', 'Spa')->get(),
            'mice'         => PageSetting::where('page_code', 'Mice')->get(),
            'wedding'      => PageSetting::where('page_code', 'Wedding')->get(),
            'functionroom' => PageSetting::where('page_code', 'Function')->get(),
            'newsletter'   => PageSetting::where('page_code', 'Newsletter')->get(),
            'contact'      => PageSetting::where('page_code', 'Contact')->get()
        ];
    }

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException){
            return redirect()->back()->with('warning', 'Your Image size cannot more than 2mb !');
        }

        if($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
            return redirect()->back();
        }

        if ($n = 2){
            $a = 1;
        }else{
            $a = 2;
        }

        if ($this->isHttpException($exception)) {
            $setting = $this->setting();
            $menu    = $this->menu();
            switch ($exception->getStatusCode()) {

                // not authorized
                case '403':
                    // return \Response::view('errors.403',array(),403);
                    break;

                // not found
                case '404':
                    return \Response::view('errors.404', get_defined_vars(),404);
                    break;

                // internal error
                case '500':
                    // return \Response::view('errors.500',array(),500);
                    break;

                default:
                    // return $this->renderHttpException($e);
                    break;
            }
        }

        return parent::render($request, $exception);
    }
}
