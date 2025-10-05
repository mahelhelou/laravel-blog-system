@extends('layouts.app')

@section('title','Home')

@section('content')
<div class="p-4 bg-white rounded shadow-sm">

  <h1 class="mb-3">مرحباً بك في نظام إدارة المقالات</h1>

  {{-- show success/errors --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row">
    <div class="col-md-6">
      {{-- If guest: show register & login forms --}}
      @guest
        <div class="card mb-3">
          <div class="card-body">
            <h5>التسجيل</h5>
            <form action="{{ route('register') }}" method="post">
              @csrf
              <div class="mb-2"><input name="name" class="form-control" placeholder="Name" required></div>
              <div class="mb-2"><input name="email" class="form-control" type="email" placeholder="Email" required></div>
              <div class="mb-2"><input name="password" class="form-control" type="password" placeholder="Password" required></div>
              <div class="mb-2"><input name="password_confirmation" class="form-control" type="password" placeholder="Confirm Password" required></div>
              <button class="btn btn-success">تسجيل</button>
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5>الدخول</h5>
            <form action="{{ route('login') }}" method="post">
              @csrf
              <div class="mb-2"><input name="email" class="form-control" type="email" placeholder="Email" required></div>
              <div class="mb-2"><input name="password" class="form-control" type="password" placeholder="Password" required></div>
              <button class="btn btn-primary">الدخول</button>
            </form>
          </div>
        </div>

      @else
        {{-- authenticated user info and quick links --}}
        <div class="card">
          <div class="card-body">
            <h5>Welcome, {{ Auth::user()->name }}</h5>
            <p>{{ Auth::user()->email }}</p>

            <form action="{{ route('logout') }}" method="post" class="d-inline">
              @csrf
              <button class="btn btn-outline-secondary">Logout</button>
            </form>

            <a href="{{ route('articles.create') }}" class="btn btn-success ms-2">Create Article</a>
            <a href="{{ route('articles.index') }}" class="btn btn-primary ms-2">View Articles</a>
          </div>
        </div>
      @endguest
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5>عن الموقع</h5>
          <p>يمكنك التسجيل أو تسجيل الدخول هنا لإنشاء مقالات. فقط صاحب المقال يمكنه التعديل أو الحذف.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
