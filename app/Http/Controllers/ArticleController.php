<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Show all articles
    public function index()
    {
        $articles = DB::table('articles')->join('users', 'articles.user_id', '=', 'users.id')->select('articles.id', 'articles.title', 'articles.content', 'users.name as author', 'articles.created_at')->get();

        return response()->json($articles);
    }

    // Create a new article
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        $userId = Auth::id();
        if (!$userId && !$request->filled('user_id')) {
            return response()->json(['error' => 'User not authenticated or provided'], 401);
        }

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $userId ?? $request->user_id,
        ]);

        return response()->json($article, 201);
    }

    // View single article
    public function show($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);

        }

        return response()->json($article, 201);
    }

    // Update an article
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required'
        ]);

        $article->update($request->only(['title', 'content']));

        return response()->json($article, 201);
    }

    // Delete an article
    public function delete($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        $article->delete();

        return response()->json(['message' => 'Article deleted successfully'], 201);
    }
}
