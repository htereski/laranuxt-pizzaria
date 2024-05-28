<?php

namespace App\Http\Controllers;

use App\Http\Requests\KindRequest;
use App\Http\Resources\KindResourceCollection;
use App\Models\Kind;

class KindController extends Controller
{
    public function index()
    {
        $data = Kind::paginate(5);

        if (!$data->items()) {
            return response()->json(['message' => 'Kind not founded'], 400);
        }

        $kinds = new KindResourceCollection($data);

        return response()->json($kinds, 200);
    }

    public function store(KindRequest $request)
    {
        $request->validated();

        $kind = new Kind();
        $kind->name = $request->name;
        $kind->multiplier = $request->multiplier;
        $kind->save();

        return response()->json(['message' => 'Kind Created'], 201);
    }

    public function update(KindRequest $request, $id)
    {
        $request->validated();

        $kind = Kind::find($id);

        if ($kind) {
            $kind->name = $request->name;
            $kind->multiplier = $request->multiplier;
            $kind->save();

            return response()->json(['message' => 'Kind Updated'], 200);
        }

        return response()->json(['message' => 'Kind not founded'], 400);
    }

    public function destroy($id)
    {
        $kind = Kind::find($id);

        if ($kind) {
            $kind->delete();

            return response()->json(['message' => 'Kind Deleted'], 200);
        }

        return response()->json(['message' => 'Kind not founded'], 400);
    }
}
