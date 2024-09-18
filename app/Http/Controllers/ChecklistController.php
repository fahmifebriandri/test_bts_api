<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use Illuminate\Support\Facades\Validator;

class ChecklistController extends Controller
{
    // Membuat Checklist
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $checklist = Checklist::create([
            'title' => $request->input('title'),
        ]);

        return response()->json([
            'message' => 'Checklist created successfully',
            'checklist' => $checklist,
        ], 201);
    }

    // Menghapus Checklist
    public function destroy($id)
    {
        $checklist = Checklist::find($id);

        if (!$checklist) {
            return response()->json([
                'message' => 'Checklist not found'
            ], 404);
        }

        $checklist->delete();

        return response()->json([
            'message' => 'Checklist deleted successfully'
        ]);
    }

    // Menampilkan semua Checklist
    public function index()
    {
        $checklists = Checklist::all();
        return response()->json($checklists);
    }

    // Menampilkan Detail Checklist
    public function show($id)
    {
        $checklist = Checklist::with('items')->find($id);

        if (!$checklist) {
            return response()->json([
                'message' => 'Checklist not found'
            ], 404);
        }

        return response()->json($checklist);
    }
}
