@extends('layouts.app')

@section('template_title')
    {!! trans('organization.editing-branch', ['name' => $branch_type->branch_type]) !!}
@endsection

@section('template_linked_css')
    <style type="text/css">
        .btn-save,
        .pw-change-container {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('organization.editing-branch', ['name' => $branch_type->branch_type]) !!}
                            <div class="pull-right">
                                <a href="{{ route('branch-type') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('organization.buttons.back-to-branches') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('organization.buttons.back-to-branchtypes') !!}
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('url' => ['branch-type-update', $branch_type->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('branch_type') ? ' has-error ' : '' }}">
                                {!! Form::label('name', trans('forms.branch_type'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('branch_type', $branch_type->branch_type, array('id' => 'branch_type', 'class' => 'form-control', 'placeholder' => trans('forms.branch_name'))) !!}

                                        <div class="input-group-append">
                                            <label class="input-group-text" for="name">
                                                <i class="fa fa-fw {{ trans('forms.branch_type') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if($errors->has('name'))
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



                                        <option value="1" {{ $branch_type->status == 1 ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ $branch_type->status == 0 ? 'selected="selected"' : '' }}>Deactivate</option>


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










                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_branch__modal_text_confirm_title'), 'data-message' => trans('modals.edit_branch__modal_text_confirm_message'))) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')
@endsection
