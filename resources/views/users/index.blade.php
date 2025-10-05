@extends('layouts.app')

@section('title','Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>المستخدمون</h2>
  <a href="{{ route('users.create') }}" class="btn btn-success">إنشاء مستخدم</a>
</div>

<div class="card">
  <div class="card-body">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>الاسم</th>
          <th>البريد الإلكتروني</th>
          <th>الإجراءات</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td style="width:240px">
            <a href="{{ route('users.show',$user->id) }}" class="btn btn-sm btn-primary">عرض</a>
            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-warning">تعديل</a>

            <form action="{{ route('users.destroy',$user->id) }}" method="post" class="d-inline"
                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">حذف</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $users->links() ?? '' }}
  </div>
</div>
@endsection
