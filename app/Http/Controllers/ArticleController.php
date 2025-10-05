<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('articles.index', compact('articles'));
    }

    // GET /articles/create
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('articles.create', compact('users'));
    }

    // POST /articles
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        Article::create($request->only(['title','content','user_id']));
        return redirect()->route('articles.index')->with('success', 'Article created');
    }

    // GET /articles/{id}
    public function show($id)
    {
        $article = Article::with('user')->findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // GET /articles/{id}/edit
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $users = User::orderBy('name')->get();
        return view('articles.edit', compact('article', 'users'));
    }

    // PUT /articles/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $article = Article::findOrFail($id);
        $article->update($request->only(['title','content','user_id']));

        return redirect()->route('articles.index')->with('success', 'Article updated');
    }

    // DELETE /articles/{id}
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted');
    }
}
