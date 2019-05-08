@extends('layouts.app')

@section('template_title')
    {!! trans('organization.create-new-branch') !!}
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('usersmanagement.create-new-user') !!}
                            <div class="pull-right">
                                <a href="{{ route('branch.index') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('organization.buttons.back-to-branches') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'branch.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('branch_name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('forms.branch_name'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('branch_name','', array('id' => 'branch_name', 'class' => 'form-control', 'placeholder' => trans('forms.branch_name'))) !!}

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw {{ trans('forms.branch_name') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('branch_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('branch_code') ? ' has-error ' : '' }}">
                            {!! Form::label('branch_code', trans('forms.branch_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('branch_code', '', array('id' => 'branch_code', 'class' => 'form-control', 'placeholder' => trans('forms.branch_code'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="first_name">
                                            <i class="fa fa-fw {{ trans('forms.branch_code') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if($errors->has('branch_code'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('branch_code') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('address') ? ' has-error ' : '' }}">
                            {!! Form::label('address', trans('forms.address'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('address', '', array('id' => 'address', 'class' => 'form-control', 'placeholder' => trans('forms.address'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="last_name">
                                            <i class="fa fa-fw {{ trans('forms.address') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if($errors->has('address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('contact_number') ? ' has-error ' : '' }}">
                            {!! Form::label('contact', trans('forms.contact'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('contact_number', '', array('id' => 'contact_number', 'class' => 'form-control', 'placeholder' => trans('forms.contact'))) !!}
                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.contact') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('contact'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('contact_number') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                            {!! Form::label('email', trans('forms.email'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('email', '', array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.email'))) !!}
                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.email') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('contact'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('branch_type') ? ' has-error ' : '' }}">

                            {!! Form::label('branch_type', trans('forms.branch_type'), array('class' => 'col-md-3 control-label')); !!}

                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="branch_type" id="branch_type">
                                        <option value="">{{ trans('forms.branch_type_ph') }}</option>
                                        @if ($types)
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->branch_type }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="role">
                                            <i class="{{ trans('forms.branch_type') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('branch_type'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('branch_type') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('status') ? ' has-error ' : '' }}">

                            {!! Form::label('status', trans('forms.status'), array('class' => 'col-md-3 control-label')); !!}

                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="status" id="status">



                                        <option value="1">Active</option>
                                        <option value="0">Deactivate</option>


                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="role">
                                            <i class="{{ trans('forms.status') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('branch_type'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                            {!! Form::button(trans('forms.create_branch_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
