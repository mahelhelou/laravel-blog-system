@extends('layouts.app')

@section('title','Articles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>المقالات</h2>
  <a href="{{ route('articles.create') }}" class="btn btn-success">إنشاء مقال</a>
</div>

<div class="card">
  <div class="card-body">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>العنوان</th>
          <th>الكاتب</th>
          <th>تاريخ الإنشاء</th>
          <th>الإجراءات</th>
        </tr>
      </thead>
      <tbody>
        @foreach($articles as $a)
        <tr>
          <td>{{ $a->id }}</td>
          <td>{{ $a->title }}</td>
          <td>{{ $a->user->name ?? '—' }}</td>
          <td>{{ $a->created_at->format('Y-m-d') }}</td>
          <td style="width:260px">
            <a href="{{ route('articles.show',$a->id) }}" class="btn btn-sm btn-primary">عرض</a>
            <a href="{{ route('articles.edit',$a->id) }}" class="btn btn-sm btn-warning">تعديل</a>

            <form action="{{ route('articles.destroy',$a->id) }}" method="post" class="d-inline" onsubmit="return confirm('حذف المقال؟')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">حذف</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $articles->links() ?? '' }}
  </div>
</div>
@endsection
