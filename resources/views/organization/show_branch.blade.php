@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.showing-user', ['name' => $branch->branch_name]) !!}
@endsection


@section('content')



    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white @if ($user->activated == 1) bg-success @else bg-danger @endif">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('usersmanagement.showing-user-title', ['name' => $branch->branch_name]) !!}
                            <div class="float-right">
                                <a href="{{ route('branch.index') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('organization.buttons.back-to-branchesnav') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('organization.buttons.back-to-branches') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div align="left" class="col-sm-4 col-md-6">
                                <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                                    {{ $user->branch_name }}
                                </h4>
                                <p class="text-center text-left-tablet">
                                    <strong>
                                        {{ $branch->branch_code }} {{ $branch->branch_name }}
                                    </strong>
                                    @if($branch->email)
                                        <br />
                                        <span class="text-center" data-toggle="tooltip" data-placement="top" title="{{ trans('usersmanagement.tooltips.email-user', ['user' => $branch->email]) }}">
                      {{ Html::mailto($branch->email, $branch->email) }}
                    </span>
                                    @endif
                                </p>

                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>



                        @if ($branch->branch_name)

                            <div class="col-sm-5 col-6 text-larger">
                                <strong>
                                    {{ trans('organization.branch_table.name') }}
                                </strong>
                            </div>

                            <div class="col-sm-7">
                                {{ $branch->branch_name }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                        @endif

                        @if ($branch->branch_code)

                            <div class="col-sm-5 col-6 text-larger">
                                <strong>
                                    {{ trans('organization.branch_table.branch_code') }}
                                </strong>
                            </div>

                            <div class="col-sm-7">
                                {{ $branch->branch_code }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                        @endif

                        <div class="col-sm-5 col-6 text-larger">
                            <strong>
                                {{ trans('organization.branch_table.address') }}
                            </strong>
                        </div>
                        <div class="col-sm-7">
                            {{ $branch->address }}
                        </div>


                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="col-sm-5 col-6 text-larger">
                            <strong>
                                {{ trans('organization.statusBranch') }}
                            </strong>
                        </div>

                        <div class="col-sm-7">
                            @if ($branch->branch_code == 1)
                                {{ trans('organization.active') }}
                                @else
                                {{ trans('organization.deactivate') }}
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>



                        <div class="col-sm-7">



                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>



                        @if ($branch->created_at)

                            <div class="col-sm-5 col-6 text-larger">
                                <strong>
                                    {{ trans('usersmanagement.labelCreatedAt') }}
                                </strong>
                            </div>

                            <div class="col-sm-7">
                                {{ $branch->created_at }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                        @endif

                        @if ($branch->updated_at)

                            <div class="col-sm-5 col-6 text-larger">
                                <strong>
                                    {{ trans('usersmanagement.labelUpdatedAt') }}
                                </strong>
                            </div>

                            <div class="col-sm-7">
                                {{ $branch->updated_at }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                        @endif



                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection

