@extends('layouts.app')

@section('title',$article->title)

@section('content')
<div class="card">
  <div class="card-body">
    <h2>{{ $article->title }}</h2>
    <p class="text-muted">By: {{ $article->user->name ?? '—' }} — {{ $article->created_at->format('Y-m-d H:i') }}</p>

    <div class="mb-4">
      {!! nl2br(e($article->content)) !!}
    </div>

    <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-warning">تعديل</a>
    <a href="{{ route('articles.index') }}" class="btn btn-secondary">رجوع</a>
  </div>
</div>
@endsection
