<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{

    public $course = 'BSIT';

    public function index()
    {
        $student = "Kate";
        $message = "Hello, World!, $student";

        return response()->json([
            'student' => $student,
            'message' => $message,
            'course' => $this->course,
        ]);
    }

    public function read()
    {
                $greetingsName = $this->greet('jf')->getData(true);
        return response()->json([
                        'course' => $this->course,
                        'greeting' => $greetingsName['message'],
      ]);
    }

    public function greet($name)
    {
        return response()->json([
            'message' => "Hello, $name!",
        ]);
    }
}
