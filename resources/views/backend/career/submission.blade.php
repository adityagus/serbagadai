@extends('backend.layouts.template')

@section('pageTitle','Career Submission')

@push('customCss')
    <link href="{{url('backend/assets/global/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a> <i class="fa fa-circle"></i></li>
                    <li><a href="{{route('admin.career')}}">Karir</a> <i class="fa fa-circle"></i></li>
                    <li><span>Daftar Lamaran</span></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered margin-top-20">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-dark"></i> <span
                                        class="caption-subject font-dark bold uppercase">Daftar Lamaran</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-12 col-lg-12" style="text-align: right;">
                                    <a href="{{route('admin.career.submission.export')}}" target="_blank" class="btn btn-success">Export</a>
                                </div>
                            </div>
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td class="all">
                                        <input placeholder="Find Nama" type="text" class="form-control" name="s_name" onchange="filter()">
                                    </td>
                                    <td class="all" >
                                        <input placeholder="Find Email" type="text" class="form-control" name="s_email" onchange="filter()">
                                    </td>
                                    <td class="all" >
                                        <input placeholder="Find Phone" type="text" class="form-control" name="s_phone" onchange="filter()">
                                    </td>
                                    <td>
                                        <select class="form-control" name="s_career" onchange="filter()">
                                            <option value="">Pilih Karir</option>
                                            @foreach($careers as $career)
                                                <option value="{{$career->id}}">{{$career->title}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Karir</th>
                                    <th>Cover Letter</th>
                                    <th>File CV</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customJs')

    <script src="{{url('backend/assets/global/datatable.js')}}"
            type="text/javascript"></script>
    <script
            src="{{url('backend/assets/global/datatables/datatables.min.js')}}"
            type="text/javascript"></script>
    <script
            src="{{url('backend/assets/global/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
            type="text/javascript"></script>
    <script
            src="{{url('backend/assets/global/table-datatables-responsive.min.js')}}"
            type="text/javascript"></script>

    <script type="text/javascript">
        var table = $('#myTable').DataTable({
            'processing'  : true,
            'serverSide'  : true,
            'ajax'        : {
                url: "{{ route('admin.career.submission.data') }}",
                data: function (d) {
                    d['career_submissions.name'] = $('[name=s_name]').val();
                    d['career_submissions.email']= $('[name=s_email]').val();
                    d['career_submissions.phone']= $('[name=s_phone]').val();
                    d['career_submissions.career_id']= $('[name=s_career]').val();
                }
            },
            'dataType'    : 'json',
            'searching'   : false,
            'paging'      : true,
            'lengthChange': true,
            'columns'     : [
                {data:'name', name: 'name'},
                {data:'email', name: 'email'},
                {data:'phone', name: 'phone'},
                {data:'career_id', name: 'career_id'},
                {data:'cover_letter', name: 'cover_letter'},
                {data:'cv', name: 'cv'},
                {data:'created_at', name: 'created_at',searchable: false},
            ],
            'info'        : true,
            'order'       : ['5','desc'],
            'autoWidth'   : false
        });

        function filter() {
            table.draw();
        }

    </script>

@endpush
