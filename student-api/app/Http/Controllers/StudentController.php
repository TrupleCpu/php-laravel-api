<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    public function index()
    {
        //
        return response()->json($this->studentService->getAllStudents());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $student = $this->studentService->addStudent($request->all());

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $student = $this->studentService->getStudentById($id);

        return $student ?
                response()->json($student, 200) :
                response()->json(['message' => 'Student not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $student = $this->studentService->updateStudent($id, $request->all());

        return $student ?
               response()->json($student, 200) :
               response()->json(['message' => 'Student not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleted = $this->studentService->deleteStudent($id);

        
        return $deleted ?
               response()->json(['message'=> 'Student deleted'], 200) :
               response()->json(['message' => 'Student not found'], 404);
    }
}
