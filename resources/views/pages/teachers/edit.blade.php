@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('site.edit_teacher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('site.edit_teacher') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('teachers.update', $teacher->id)}}" method="post">
                             {{method_field('patch')}}
                             @csrf

                             <input type="hidden" value="{{$teacher->id}}" name="id">


                            <div class="form-row">
                                <div class="col">
                                    <label for="email">{{trans('site.email')}}</label>
                                    <input type="email" name="email" value="{{$teacher->email}}" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="password">{{trans('site.password')}}</label>
                                    <input type="password" name="password" value="{{$teacher->password}}" class="form-control">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="name_ar">{{trans('site.name_ar')}}</label>
                                    <input type="text" name="name_ar" value="{{ $teacher->getTranslation('name', 'ar') }}" class="form-control">
                                    @error('name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="name_en">{{trans('site.name_en')}}</label>
                                    <input type="text" name="name_en" value="{{ $teacher->getTranslation('name', 'en') }}" class="form-control">
                                    @error('name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="specialisation_id">{{trans('site.specialisation')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="specialisation_id">
                                        @foreach($specialisations as $specialisation)
                                            <option value="{{$specialisation->id}}" 
                                                {{$specialisation->id == $teacher->specialisation_id ? 'selected' : ''}}>
                                                {{$specialisation->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('specialisation_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="gender_id">{{trans('site.gender')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}" {{ $gender->id == $teacher->gender_id ? "selected" : '' }}>
                                                {{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="joining_date">{{trans('site.joining_date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action"  value="{{$teacher->joining_date}}" name="joining_date" data-date-format="yyyy-mm-dd"  required>
                                    </div>
                                    @error('joining_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('site.address')}}</label>
                                <textarea class="form-control" name="address"
                                          id="exampleFormControlTextarea1" rows="4">{{$teacher->address}}</textarea>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('site.next')}}</button>
                    </form>
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