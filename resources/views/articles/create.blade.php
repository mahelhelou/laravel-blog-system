@extends('layouts.app')

@section('title','Create Article')

@section('content')
<div class="card">
  <div class="card-body">
    <h3>إنشاء مقال</h3>

    <form action="{{ route('articles.store') }}" method="post">
      @csrf

      <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="form-control" value="{{ old('title') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Author (user)</label>
        <select name="user_id" class="form-select" required>
          <option value="">-- choose user --</option>
          @foreach($users as $u)
            <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
              {{ $u->name }} ({{ $u->email }})
            </option>
          @endforeach
        </select>
      </div>

      <button class="btn btn-success">حفظ</button>
      <a href="{{ route('articles.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
  </div>
</div>
@endsection
