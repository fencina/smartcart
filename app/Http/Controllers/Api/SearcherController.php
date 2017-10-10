<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearcherController extends Controller
{
    public function search(Request $request)
    {
        $modelClass = $this->getModelNamespace() . ucfirst(str_singular($request->route('model')));

        if (!class_exists($modelClass)) {
            throw  new ModelNotFoundException();
        }

        $queryBuilder = call_user_func([$modelClass, 'query']);

        foreach ($request->query() as $field => $value) {
            $queryBuilder->where($field, 'like', '%'.$value.'%');
        }

        return response()->json($queryBuilder->get());
    }

    public function getModelNamespace()
    {
        return 'App\\';
    }
}
