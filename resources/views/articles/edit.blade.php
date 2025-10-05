@extends('layouts.app')

@section('title','Edit Article')

@section('content')
<div class="card">
  <div class="card-body">
    <h3>تعديل المقال</h3>

    <form action="{{ route('articles.update',$article->id) }}" method="post">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">عنوان المقال</label>
        <input name="title" type="text" class="form-control" value="{{ old('title',$article->title) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">محتوى المقال</label>
        <textarea name="content" rows="6" class="form-control" required>{{ old('content',$article->content) }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">الكتاتب (اليوزر)</label>
        <select name="user_id" class="form-select" required>
          @foreach($users as $u)
            <option value="{{ $u->id }}" {{ (old('user_id',$article->user_id) == $u->id) ? 'selected' : '' }}>
              {{ $u->name }}
            </option>
          @endforeach
        </select>
      </div>

      <button class="btn btn-warning">تحديث</button>
      <a href="{{ route('articles.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
  </div>
</div>
@endsection
