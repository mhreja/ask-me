@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Subjects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\Subject::count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Topics</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\Topic::count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\User::where(['is_admin' => 0])->count()}}
                            </div>
                            <i class="text-info">{{RANK1NAME}}:
                                {{\App\Models\User::where('points', '>=', RANK1MINPOINTS)->count()}}</i>
                            <br>
                            <i class="text-warning">{{RANK2NAME}}:
                                {{\App\Models\User::where('points', '>=', RANK2MINPOINTS)->count()}}</i>
                            <br>
                            <i class="text-secondary">{{RANK3NAME}}:
                                {{\App\Models\User::where('points', '>=', RANK3MINPOINTS)->count()}}</i>
                            <br>
                            <i class="text-danger">{{RANK4NAME}}:
                                {{\App\Models\User::where('points', '>=', RANK4MINPOINTS)->count()}}</i>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Questions</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\Question::count()}}
                            </div>
                            <i class="text-info">Approved:
                                {{\App\Models\Question::where('is_approved', 1)->count()}}</i>
                            <br>
                            <i class="text-success">Favorite:
                                {{\App\Models\Question::where('is_favorite', 1)->count()}}</i>
                            <br>
                            <i class="text-danger">Rejected:
                                {{\App\Models\Question::whereNotNull('rejection_comment')->count()}}</i>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-question fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Answers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\Answer::count()}}

                            </div>
                            <i class="text-info">Approved: {{\App\Models\Answer::where('is_approved', 1)->count()}}</i>
                            <br>
                            <i class="text-success">Correct:
                                {{\App\Models\Answer::where('is_correct_marked', 1)->count()}}</i>
                            <br>
                            <i class="text-danger">Rejected:
                                {{\App\Models\Answer::whereNotNull('rejection_comment')->count()}}</i>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pen fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection