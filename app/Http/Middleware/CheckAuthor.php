<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Article;

/*
 * CheckAuthor middleware
 * Simple English comment: Ensure the current user is the author of the article.
 *
 * Behavior:
 * - If a user is authenticated (session or token), uses $request->user().
 * - If not authenticated and environment is 'local', accepts `user_id` from request as a testing fallback.
 * - Works with route-model binding (route param 'article') or with numeric id param ('id' or 'article_id').
 *
 * IMPORTANT: Remove the local fallback before production/submission for security.
 */
class CheckAuthor
{
    public function handle(Request $request, Closure $next)
    {
        // 1) try to get route parameter (resource routes usually use {article})
        $param = $request->route('article') ?? $request->route('id') ?? $request->route('article_id');

        // If route-model-binding gives an Article instance, use it
        if ($param instanceof Article) {
            $article = $param;
        } elseif ($param) {
            $article = Article::find($param);
        } else {
            // no article id in route — cannot check author
            abort(400, 'article id is required in route');
        }

        if (! $article) {
            abort(404, 'article not found');
        }

        // 2) get authenticated user (works for session auth or token-based guards like sanctum)
        $user = $request->user(); // respects auth guard

        // 3) local testing fallback: allow passing user_id in request when env=local (ONLY FOR DEV)
        if (! $user) {
            if (app()->environment('local') && $request->filled('user_id')) {
                // use the provided user_id only in local environment for testing convenience
                $actorId = (int) $request->input('user_id');
            } else {
                abort(403, 'you must be logged in to perform this action');
            }
        } else {
            $actorId = $user->id;
        }

        // 4) final check
        if ($actorId !== $article->user_id) {
            abort(403, 'forbidden: you are not the author of this article');
        }

        return $next($request);
    }
}
