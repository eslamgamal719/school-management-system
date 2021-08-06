@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('site.list_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('site.list_students')}}
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
                                <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('site.add_student')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('site.name')}}</th>
                                            <th>{{trans('site.email')}}</th>
                                            <th>{{trans('site.gender')}}</th>
                                            <th>{{trans('site.grade')}}</th>
                                            <th>{{trans('site.classrooms')}}</th>
                                            <th>{{trans('site.section')}}</th>
                                            <th>{{trans('site.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->gender->name }}</td>
                                            <td>{{ $student->grade->name }}</td>
                                            <td>{{ $student->classroom->name }}</td>
                                            <td>{{ $student->section->name }}</td>
                                                <td>
                                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{ trans('site.edit') }}"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $student->id }}" title="{{ trans('site.delete') }}"><i class="fa fa-trash"></i></button>
                                                    <a href="{{route('students.show', $student->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true" title="{{ trans('site.show') }}"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @include('pages.students.delete')
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