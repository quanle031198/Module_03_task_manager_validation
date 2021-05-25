@extends('home')

@section('title', 'Thêm mới công viêc')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Thêm mới công việc</h2>
        </div>
        <div class="error-message">
            @if ($errors->any())
                @foreach($errors->all() as $nameError)
                    <p style="color:red">{{ $nameError }}</p>
                @endforeach
            @endif
        </div>
        <div class="col-md-12">
            <form method="post" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên công việc</label>
                    <input type="text" class="form-control" name="title">
                </div>

                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea class="form-control" rows="3" name="content"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Ảnh</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Ngày hết hạn</label>
                    <input type="date" name="due_date" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
            </form>
        </div>
    </div>
@endsection