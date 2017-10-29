<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Requests\GroupFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        return response()->json(Auth::user()->groups->load('clients'));
    }

    public function store(GroupFormRequest $request)
    {
        $group = new Group();
        $group->name = $request->input('name');
        $group->save();

        $group->clients()->attach($request->user()->id, ['owner' => true]);

        if ($request->has('members')) {
            $group->clients()->attach($request->input('members'));
        }

        return response()->json($group->load('clients'));
    }

    public function update(GroupFormRequest $request, Group $group)
    {
        if ($request->has('name')) {
            $group->name = $request->input('name');
            $group->save();
        }

        if ($request->has('members')) {
            $members = $request->input('members');
            array_push($members, $request->user()->id);
            $group->clients()->sync($members);
        }

        return response()->json($group->load('clients'));
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json(['message' => 'Grupo eliminado']);
    }
}
