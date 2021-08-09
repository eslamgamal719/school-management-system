@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('site.list_graduate')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('site.list_graduate')}} <i class="fa fa-user-graduate"></i>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('site.student_name')}}</th>
                                            <th>{{trans('site.email')}}</th>
                                            <th>{{trans('site.gender')}}</th>
                                            <th>{{trans('site.grade')}}</th>
                                            <th>{{trans('site.classrooms')}}</th>
                                            <th>{{trans('site.section')}}</th>
                                            <th>{{trans('site.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($graduates as $graduate)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $graduate->name }}</td>
                                            <td>{{ $graduate->email }}</td>
                                            <td>{{ $graduate->gender->name }}</td>
                                            <td>{{ $graduate->grade->name }}</td>
                                            <td>{{ $graduate->classroom->name }}</td>
                                            <td>{{ $graduate->section->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#return_student{{ $graduate->id }}" title="{{ trans('site.delete') }}">ارجاع الطالب</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $graduate->id }}" title="{{ trans('site.delete') }}">حذف الطالب</button>

                                                </td>
                                            </tr>
                                        @include('pages.students.graduates.return')
                                        @include('pages.students.graduates.delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection