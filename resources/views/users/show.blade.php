@extends('layouts.app')

@section('title','View User')

@section('content')
<div class="card">
  <div class="card-body">
    <h3>معلومات المستخدم</h3>

    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning">تعديل</a>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">رجوع</a>
  </div>
</div>
@endsection
