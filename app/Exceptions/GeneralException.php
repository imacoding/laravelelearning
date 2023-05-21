<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Exception;
use Throwable;

class GeneralException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     * @return void
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception to the application's error handling system.
     *
     * @return void
     */
    public function report()
    {
        // Log the exception
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        /*
         * All instances of GeneralException redirect back with a flash message to show a bootstrap alert-error
         */
        return redirect()
            ->back()
            ->withInput($request->except('password', 'password_confirmation'))
            ->with('danger', $this->message);
    }
}
