<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints filesystem destination
    |--------------------------------------------------------------------------
    |
    | This configuration option defines the base directory where the fast-endpoints
    | package will start scanning for endpoint classes. It is important that all
    | your endpoint classes are located within or under this directory to ensure
    | they are automatically detected and registered. The package will recursively
    | scan this directory and its subdirectories for endpoint classes to generate
    | the necessary routes.
    |
    */
    "dist" => app_path("Http/Controllers"),

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes prefix
    |--------------------------------------------------------------------------
    |
    | The "prefix" option allows you to prepend a common URI segment to all routes
    | generated by the fast-endpoints package. This is useful for organizing your
    | routes under a specific path, such as "/api" or "/v1". For example, if you
    | set the prefix to "fast", a route like "/users" would be accessible at
    | "/fast/users". If you prefer not to use a prefix, leave this value
    | empty, and the routes will be registered without any additional URI segment.
    |
    */
    "prefix" => "",

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes domain
    |--------------------------------------------------------------------------
    |
    | This option allows you to specify a domain that all fast-endpoints routes
    | should respond to. If set to null, the routes will be available on any
    | domain. This is useful if you want to restrict certain routes to specific
    | subdomains within your application.
    |
    */
    "domain" => null,

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes middleware
    |--------------------------------------------------------------------------
    |
    | This option allows you to specify middleware that will be applied to all
    | fast-endpoints routes. Middleware can handle tasks like authentication,
    | authorization, or other request filtering. If set to null, no middleware
    | will be automatically applied to these routes.
    |
    */
    "middleware" => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes groups
    |--------------------------------------------------------------------------
    |
    | This option allows you to define additional route groups for fast-endpoints.
    | You can specify multiple groups, each with its own set of configurations
    | such as domain, prefix, or middleware. This provides flexibility in managing
    | different sets of routes with distinct characteristics.
    |
    | Additionally, you can apply these predefined groups directly to your endpoint
    | classes using the Group attribute. This enables you to organize and manage
    | your routes more effectively by assigning specific configurations through
    | attributes at the class level.
    |
    */
    "groups" => null,

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes namespaces
    |--------------------------------------------------------------------------
    |
    | This option allows you to define configurations that will be automatically
    | applied to routes based on the namespaces of the endpoint classes.
    | Similar to groups, but with the advantage of auto-applying settings
    | based on the structure of your endpoint namespaces. This ensures that
    | routes are configured consistently without needing to manually group them.
    |
    */
    "namespaces" => null,


    /*
    |--------------------------------------------------------------------------
    | Fast Endpoints Request Handler
    |--------------------------------------------------------------------------
    |
    | This configuration option specifies the default class used for handling
    | incoming requests for Fast Endpoints. By default, it is set to Laravel's
    | Illuminate\Http\Request class, which provides the request handling functionality.
    |
    */
    "request" => Illuminate\Http\Request::class,

    /*
    |--------------------------------------------------------------------------
    | Fast Endpoints Response Handler
    |--------------------------------------------------------------------------
    |
    | This configuration option specifies the default class used for handling
    | responses for Fast Endpoints. By default, it is set to Laravel's
    | Illuminate\Http\Response class, which provides the response handling functionality.
    |
    */
    "response" => Illuminate\Http\Response::class,
];
