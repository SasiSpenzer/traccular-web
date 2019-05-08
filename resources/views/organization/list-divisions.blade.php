@extends('layouts.app')

@section('template_title')
  {!! trans('organization.showing-all-divisions') !!}
@endsection

@section('template_linked_css')
  @if(config('usersmanagement.enabledDatatablesJs'))
    <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
  @endif
  <style type="text/css" media="screen">
    .users-table {
      border: 0;
    }
    .users-table tr td:first-child {
      padding-left: 15px;
    }
    .users-table tr td:last-child {
      padding-right: 15px;
    }
    .users-table.table-responsive,
    .users-table.table-responsive table {
      margin-bottom: 0;
    }
  </style>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">

            <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {!! trans('organization.showing-all-divisions') !!}
                            </span>

              <div class="btn-group pull-right btn-group-xs">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                  <span class="sr-only">

                                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="branch-division-create">
                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                    {!! trans('organization.create-new-division') !!}
                  </a>

                </div>
              </div>
            </div>
          </div>

          <div class="card-body">

            <div class="row">
              <div class="col-sm-3">

                {!! Form::open(array('url' => 'branch-divisions' . '', 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Search')) !!}
                {!! Form::hidden('_method', 'POST') !!}
                <input  type="text" class="form-control" name="branchSelect" placeholder="Search Branch By Branch Code"> <br>

                {!! Form::button('Search', array('class' => 'btn btn-primary btn-sm','type' => 'submit', 'style' =>'width: 100%;' , )) !!}
                {!! Form::close() !!}
              </div>
            </div>

              @include('partials.search-division-form')


            <div class="table-responsive users-table">
              <table class="table table-striped table-sm data-table">
                <caption id="user_count">
                  {{ trans_choice('organization.captionD', 1, ['userscount' => $divisions->count()]) }}
                </caption>
                <thead class="thead">
                <tr>
                  <th>{!! trans('organization.branch_table.id') !!}</th>
                  <th>{!! trans('organization.branch_table.division_code') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.contact') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.emailD') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.status') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.created') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.updated') !!}</th>
                  <th class="hidden-xs">Actions</th>

                </tr>
                </thead>
                <tbody id="branch_type_table">
                @foreach($divisions as $division)
                  <tr>
                    <td>{{$division->id}}</td>
                    <td>{{$division->division_code}}</td>
                    <td>{{$division->contact_number}}</td>
                    <td>{{$division->email}}</td>
                    <td>{{$division->status}}</td>
                    <td>{{$division->created_at}}</td>
                    <td>{{$division->updated_at}}</td>


                    <td align="center">
                      {!! Form::open(array('url' => 'branch-division-delete/' . $division->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                      {!! Form::hidden('_method', 'POST') !!}
                      {!! Form::button(trans('organization.buttons.deletetypeD'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Branch', 'data-message' => 'Are you sure you want to delete this Branch ?')) !!}
                      {!! Form::close() !!}
                    </td>

                    <td>
                      <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('branch-division/' . $division->id) }}" data-toggle="tooltip" title="Edit">
                        {!! trans('organization.buttons.edittypeD') !!}
                      </a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
                <tbody id="search_results"></tbody>
                @if(config('usersmanagement.enableSearchUsers'))
                  <tbody id="search_results"></tbody>
                @endif

              </table>

              @if(config('organization.enablePagination'))
                {{ $divisions->links() }}
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')
  @if ((count($divisions) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
    @include('scripts.datatables')
  @endif
  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @if(config('usersmanagement.tooltipsEnabled'))
    @include('scripts.tooltips')
  @endif
  @if(config('usersmanagement.enableSearchUsers'))
    @include('scripts.search-users')
  @endif
@endsection
