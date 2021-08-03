@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('site.list_teachers')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('site.list_teachers')}}
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
                                <a href="{{route('teachers.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('site.add_teacher') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('site.name_teacher') }}</th>
                                            <th>{{ trans('site.gender') }}</th>
                                            <th>{{ trans('site.joining_date') }}</th>
                                            <th>{{ trans('site.specialisation') }}</th>
                                            <th>{{ trans('site.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($teachers as $teacher)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->gender->name }}</td>
                                            <td>{{ $teacher->joining_date }}</td>
                                            <td>{{ $teacher->specialisation->name }}</td>
                                                <td>
                                                    <a href="{{route('teachers.edit', $teacher->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_teacher{{ $teacher->id }}" title="{{ trans('site.delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_teacher{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('teachers.destroy', $teacher->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('site.delete_teacher') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('site.warning_grade') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('site.close') }}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{ trans('site.submit') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
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