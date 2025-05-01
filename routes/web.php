<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/openapi/courses.json', function () {
    $yamlPath = base_path('openapi/courses.yaml');

    if (!file_exists($yamlPath)) {
        abort(404, 'OpenAPI file not found.');
    }

    $yaml = file_get_contents($yamlPath);
    $parsed = Yaml::parse($yaml);

    return response()->json($parsed);
});

