@extends('layouts.app')
@section('css')
<!-- DataTables -->
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
    .select2-container .select2-selection--single {
        height: 37px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        top: 74% !important;
    }
</style>
@endsection
@section('content')
<!-- Main content -->
<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title float-left">Reminder List</h3>
                <a href="{{route('reminder.create')}}" class="btn btn-block btn-success btn-flat btn-sm float-right" style="width: 13%;">Add Reminder</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="reminder-table" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Schedule Date Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
@endsection
@section('script')
<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        loadData();
    });

    function loadData() {
        $('#reminder-table').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": false,
            "pageLength": 100,
            "ajax": {
                url: "{{ route('reminder.data') }}",
                method: "get"
            },
        });
    }



    $(document).on("click", ".deleteForm", function() {
        var id = $(this).attr('data-did');
        deleteCategory(id);
    });
    function deleteCategory(id) {
        var upUrl = "{{ route('reminder.destroy','id') }}";
        Swal.fire({
            title: 'Are you sure?',
            text: "you want to delete this record?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mt-2 m-sm-1 btn-sm",
            cancelButtonClass: "btn btn-danger ml-2 m-sm-1 btn-sm",
            buttonsStyling: !1
        }).then((result) => {
            var url = upUrl;
            url = url.replace('id', id);
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    async: false,
                    url: url,
                    type: "DELETE",
                    data: {
                        id: id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(response) {
                        if(response.status==true){
                            toastr.success(response.message);
                            $('#reminder-table').DataTable().destroy();
                            loadData();
                        }
                    }
                });
            } else {
                return false;
            }
        });
    }
</script>
@endsection