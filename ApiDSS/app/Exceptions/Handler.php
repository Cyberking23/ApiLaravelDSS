<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Si la excepción es de tipo AuthenticationException (usuario no autenticado)
        if ($exception instanceof AuthenticationException) {
            // Retorna una respuesta JSON personalizada para el error de autenticación
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        // Si no es una AuthenticationException, maneja las demás excepciones con el método padre
        return parent::render($request, $exception);
    }
}
