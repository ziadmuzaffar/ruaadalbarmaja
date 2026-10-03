<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        $middleware->append(\App\Http\Middleware\CheckMaintenanceMode::class);

        $middleware->redirectTo(
            guests: '/admin/login',
            users: '/admin/dashboard',
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'الصفحة المطلوبة غير موجودة.'], 404);
            }
            if ($request->is('admin/*') || $request->is('admin')) {
                return redirect()->route('admin.dashboard')->with('error', 'الصفحة المطلوبة غير موجودة.');
            }
            return redirect()->route('home');
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'طريقة الطلب غير مدعومة للمسار المحدد.'], 405);
            }
            if ($request->is('admin/*') || $request->is('admin')) {
                return redirect()->route('admin.dashboard')->with('error', 'طريقة الطلب غير مدعومة للمسار المحدد.');
            }
            return redirect()->route('home');
        });
    })->create();
