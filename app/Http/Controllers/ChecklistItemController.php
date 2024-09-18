<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Support\Facades\Validator;

class ChecklistItemController extends Controller
{
    // Membuat Item di dalam Checklist
    public function store(Request $request, $checklistId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $checklist = Checklist::find($checklistId);

        if (!$checklist) {
            return response()->json([
                'message' => 'Checklist not found'
            ], 404);
        }

        $item = $checklist->items()->create([
            'name' => $request->input('name'),
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Item created successfully',
            'item' => $item,
        ], 201);
    }

    // Menampilkan Detail Item
    public function show($checklistId, $itemId)
    {
        $checklist = Checklist::find($checklistId);

        if (!$checklist) {
            return response()->json([
                'message' => 'Checklist not found'
            ], 404);
        }

        $item = $checklist->items()->find($itemId);

        if (!$item) {
            return response()->json([
                'message' => 'Item not found'
            ], 404);
        }

        return response()->json($item);
    }

    // Mengubah Item
    public function update(Request $request, $checklistId, $itemId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|in:pending,completed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $checklist = Checklist::find($checklistId);

        if (!$checklist) {
            return response()->json([
                'message' => 'Checklist not found'
            ], 404);
        }

        $item = $checklist->items()->find($itemId);

        if (!$item) {
            return response()->json([
                'message' => 'Item not found'
            ], 404);
        }

        $item->update($request->only(['name', 'status']));

        return response()->json([
            'message' => 'Item updated successfully',
            'item' => $item,
        ]);
    }

    // Mengubah Status Item
    public function updateStatus(Request $request, $checklistId, $itemId)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,completed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $checklist = Checklist::find($checklistId);

        if (!$checklist) {
            return response()->json([
                'message' => 'Checklist not found'
            ], 404);
        }

        $item = $checklist->items()->find($itemId);

        if (!$item) {
            return response()->json([
                'message' => 'Item not found'
            ], 404);
        }

        $item->update([
            'status' => $request->input('status'),
        ]);

        return response()->json([
            'message' => 'Item status updated successfully',
            'item' => $item,
        ]);
    }

    // Menghapus Item
    public function destroy($checklistId, $itemId)
    {
        $checklist = Checklist::find($checklistId);

        if (!$checklist) {
            return response()->json([
                'message' => 'Checklist not found'
            ], 404);
        }

        $item = $checklist->items()->find($itemId);

        if (!$item) {
            return response()->json([
                'message' => 'Item not found'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }
}
