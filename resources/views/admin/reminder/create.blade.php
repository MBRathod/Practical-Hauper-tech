@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Reminder</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{route('reminder.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                                @error('title')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{old('description')}}</textarea>
                                @error('description')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Schedule Date Time</label>
                                <input type="datetime" class="form-control" name="schedule_date_time" id="schedule_date_time" value="{{old('schedule_date_time')}}">
                                @error('schedule_date_time')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{route('reminder.index')}}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-3"></div>
</div>
@endsection
@section('script')
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
@endsection