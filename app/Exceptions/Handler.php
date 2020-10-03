<?php

namespace App\Exceptions;


use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function prepareJsonResponse($request, Throwable $e)
    {
        return response()->json(
            [
                'errors' => [
                    'title' => Str::title(Str::snake(class_basename($e), '')),
                    'details' => $e->getMessage()
                ]
            ],
            $this->isHttpException($e) ? $e->getStatusCode() : 500
        );
    }

    /**
     * For JSON:API specification, we modify Laravel's existing invalidJson method to adapt JSON:API specification.
     *
     * @param \Illuminate\Http\Request $request
     * @param ValidationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        $errors = ( new Collection($exception->validator->errors()))
            ->map(function ($error, $key) {
                return [
                    'title' => 'Validation Error',
                    'details' => $error[0],
                    'source' => [
                        'pointer' => '/' . str_replace('.', '/', $key)
                    ]
                ];
            })
            ->values();
        return response()->json(
            [
                'errors' => $errors
            ],
            $exception->status
        );
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(
                [
                    'errors' => [
                        'title' => 'Unauthenticated',
                        'details' => 'You are not authenticated'
                    ]
                ],
                403
            );
        }
        return redirect()->guest($exception->redirectTo() ?? route('login'));
    }
}
