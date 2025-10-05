@extends('layouts.app')

@section('title','Edit User')

@section('content')
<div class="card">
  <div class="card-body">
    <h3>تعديل المستخدم</h3>

    <form action="{{ route('users.update',$user->id) }}" method="post">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">الاسم الكامل</label>
        <input name="name" type="text" class="form-control" value="{{ old('name',$user->name) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">البريد الإلكتروني</label>
        <input name="email" type="email" class="form-control" value="{{ old('email',$user->email) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">كلمة المرور (اترك الحقل فارغ للاحتفاظ بالكلمة القديمة)</label>
        <input name="password" type="password" class="form-control">
      </div>

      <button class="btn btn-warning">تحديث</button>
      <a href="{{ route('users.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
  </div>
</div>
@endsection
