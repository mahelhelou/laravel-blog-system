<?php

namespace App\Http\Middleware;

use Article;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $articleId = $request->route('id');
        if (!$articleId) {
            return response()->json(['error' => 'Article ID not provided'], 400);
        }

        $article = Article::find($articleId);
        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        if (!Author::check()) {
            return response()->json(['message' => 'You must be logged in.'], 403);
        }

        if (Author::id() !== $article->user_id) {
            return response()->json(['error' => 'Unauthorized action'], 403);
        }

        return $next($request);
    }
}
