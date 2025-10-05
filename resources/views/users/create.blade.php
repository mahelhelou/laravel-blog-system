@extends('layouts.app')

@section('title','Create User')

@section('content')
<div class="card">
  <div class="card-body">
    <h3>إنشاء مستخدم جديد</h3>

    <form action="{{ route('users.store') }}" method="post">
      @csrf

      <div class="mb-3">
        <label class="form-label">الاسم الكامل</label>
        <input name="name" type="text" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">البريد الإلكتروني</label>
        <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">كلمة المرور</label>
        <input name="password" type="password" class="form-control" required>
      </div>

      <button class="btn btn-success">حفظ</button>
      <a href="{{ route('users.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
  </div>
</div>
@endsection
