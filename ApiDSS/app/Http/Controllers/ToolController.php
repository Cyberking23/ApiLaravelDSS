<?php

// app/Http/Controllers/ToolController.php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::all();
        return response()->json($tools);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'quantity' => 'nullable|int|max:500',
            'location' => 'nullable|string|max:500',
        ]);

        $tool = Tool::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'location' => $request->location,
            // 'user_id' => auth()->id(),
        ]);

        return response()->json($tool, 201);
    }

    public function show($id)
    {
        $tool = Tool::find($id);
        if (!$tool) {
            return response()->json(['message' => 'Tool not found'], 404);
        }

        return response()->json($tool);
    }

    public function update(Request $request, $id)
    {
        $tool = Tool::find($id);
        if (!$tool) {
            return response()->json(['message' => 'Tool not found'], 404);
        }

        // Validación de los datos de entrada (puedes agregar reglas de validación aquí)
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer',
            'location' => 'sometimes|string|max:255',
        ]);

        // Actualizamos solo los campos que fueron enviados
        $tool->fill($validatedData);

        // Guardamos los cambios
        $tool->save();

        return response()->json($tool);
    }


    public function destroy($id)
    {
        $tool = Tool::find($id);
        if (!$tool) {
            return response()->json(['message' => 'Tool not found'], 404);
        }

        $tool->delete();
        return response()->json(['message' => 'Tool deleted']);
    }
}
