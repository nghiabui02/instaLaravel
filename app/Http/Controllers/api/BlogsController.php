<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    public function index(): JsonResponse
    {
        $blogs = DB::table('blogs')
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->select('blogs.*', 'users.name as name', 'users.username as username')
            ->get();
        return response()->json($blogs);
    }

    public function getOne(Request $request): JsonResponse
    {
        $blog = DB::table('blogs')
            ->where('id', $request->id)
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->select('blogs.*', 'users.name as name', 'users.username as username')
            ->first();
        return response()->json($blog);
    }

    public function create(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|integer',
            'image' => 'nullable',
            'created_at' => 'nullable',
        ]);

        if (empty($validatedData['created_at'])) {
            $validatedData['created_at'] = Carbon::now('UTC +7')->format('Y-m-d H:i:s');
        }

        if ($request->hasFile('image')) {

            $customFileName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('images', $customFileName, 'local');
            $validatedData['image'] = 'http://127.0.0.1:8000/api/' . $imagePath;

        }

        $blog = DB::table('blogs')->insert($validatedData);

        return response()->json(['success' => true, 'data' => $blog]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'user_id' => 'required',
            'image' => 'nullable|string'
        ]);

        if (empty($validatedData['updated_at'])) {
            $validatedData['updated_at'] = Carbon::now('UTC +7')->format('Y-m-d H:i:s');
        }

        $blog = DB::table('blogs')
            ->where('id', $id)
            ->update($validatedData);

        return response()->json($blog);
    }

    public function destroy($id): JsonResponse
    {
        $blog = DB::table('blogs')->where('id', $id)->delete();
        return response()->json($blog);
    }

    public function View()
    {
        return view('blogs.index');
    }
}
