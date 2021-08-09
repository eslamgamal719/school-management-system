<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('site.dashboard') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="index.html">Dashboard 01</a> </li>
                            <li> <a href="index-02.html">Dashboard 02</a> </li>
                            <li> <a href="index-03.html">Dashboard 03</a> </li>
                            <li> <a href="index-04.html">Dashboard 04</a> </li>
                            <li> <a href="index-05.html">Dashboard 05</a> </li>
                        </ul>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                   

                    <!-- Grades-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{ trans('site.grades') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('grades.index') }}">{{ trans('site.grades_list') }}</a></li>
                        </ul>
                    </li>


                    <!-- Classrooms-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">{{trans('site.classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('classrooms.index')}}">{{trans('site.list_classes')}}</a></li>
                        </ul>
                    </li>

                    <!-- sections-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                            <div class="pull-left"><i class="fa fa-building"></i></i><span
                                    class="right-nav-text">{{trans('site.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('sections.index')}}">{{trans('site.list_sections')}}</a></li>
                        </ul>
                    </li>
     
                    <!-- Parents-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                            <div class="pull-left"><i class="fa fa-users"></i><span
                                    class="right-nav-text">{{trans('site.parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ url('add_parent') }}">{{trans('site.list_parents')}}</a> </li>
                        </ul>
                    </li>


                <!-- students-->
                <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fa fa-graduation-cap"></i>{{trans('site.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                <ul id="students-menu" class="collapse">
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('site.student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="Student_information" class="collapse">
                            <li> <a href="{{route('students.create')}}">{{trans('site.add_student')}}</a></li>
                            <li> <a href="{{route('students.index')}}">{{trans('site.list_students')}}</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('site.students_promotions')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="Students_upgrade" class="collapse">
                            <li> <a href="{{route('promotions.index')}}">{{trans('site.add_promotion')}}</a></li>
                            <li> <a href="{{route('promotions.create')}}">{{trans('site.list_promotions')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('site.graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="Graduate students" class="collapse">
                            <li> <a href="{{ route('graduates.create') }}">{{trans('site.add_graduate')}}</a> </li>
                            <li> <a href="{{ route('graduates.index') }}">{{trans('site.list_graduate')}}</a> </li>
                        </ul>
                    </li>
                </ul>
            </li>


                    <!-- Teachers-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                            <div class="pull-left"><i class="fa fa-users"></i></i><span
                                    class="right-nav-text">{{trans('site.teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teachers.index')}}">{{trans('site.list_teachers')}}</a> </li>
                        </ul>
                    </li>

                    <!-- Fees -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                            <div class="pull-left"><i class="fa fa-money"></i><span
                                    class="right-nav-text">{{trans('site.accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('fees.index') }}">الرسوم الدراسية</a> </li>
                            <li> <a href="{{ route('fees_invoices.index') }}">الفواتير</a> </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
