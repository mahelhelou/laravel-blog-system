@extends('layouts.app')

@section('title','Home')

@section('content')
<div class="p-4 bg-white rounded shadow-sm">
  <h1 class="mb-3">مرحباً بك في نظام إدارة المقالات</h1>
  <p>هذا تطبيق بسيط يسمح بإنشاء وعرض وتعديل وحذف المستخدمين والمقالات. استخدم القوائم أعلاه للوصول.</p>

  <div class="row mt-4">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5>المستخدمون</h5>
          <p>إدارة المستخدمين (إنشاء، تعديل، حذف).</p>
          <a href="{{ route('users.index') }}" class="btn btn-primary">عرض المستخدمين</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 mt-3 mt-md-0">
      <div class="card">
        <div class="card-body">
          <h5>المقالات</h5>
          <p>عرض، إضافة، تعديل، حذف مقالات.</p>
          <a href="{{ route('articles.index') }}" class="btn btn-primary">عرض المقالات</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
