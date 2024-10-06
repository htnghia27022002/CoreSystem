<?php

namespace App\Http\Middlewares;

use App\Attributes\Validate;
use Closure;
use ReflectionMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateMiddleware {

    public function handle(Request $request, Closure $next) {

        $route = $request->route();
        $controller = $route->getController();
        $method = $route->getActionMethod();

        $reflectionMethod = new ReflectionMethod($controller, $method);
        $attributes = $reflectionMethod->getAttributes(Validate::class);
        if (!empty($attributes)) {
            $validateAttribute = $attributes[0]->newInstance();

            $validator = Validator::make(
                $request->all(),
                $validateAttribute->rules,
                $validateAttribute->messages
            );

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $request->replace($validator->validated());
        }

        return $next($request);
    }
}