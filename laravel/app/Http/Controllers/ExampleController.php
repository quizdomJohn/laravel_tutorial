<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage() {
        // suppose we load the data from the database
        $databaseName = 'Brad';
        $animals = ['cat', 'dog', 'pig'];
        return view('homepage',['name' => $databaseName, 'catname' => 'Braddy', 'zoo' => $animals]);
    }

    public function aboutpage() {
        return '<h1>About Page</h1><a href="/">View the Home page</a>';
    }
}
