@extends('layouts.app')

@section('template_title')
  {!! trans('organization.showing-all-branches') !!}
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
                                {!! trans('organization.showing-all-branches') !!}
                            </span>

              <div class="btn-group pull-right btn-group-xs">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                  <span class="sr-only">

                                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="/organization/branch/create">
                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                    {!! trans('organization.create-new') !!}
                  </a>

                </div>
              </div>
            </div>
          </div>

          <div class="card-body">



              @include('partials.search-branches-form')


            <div class="table-responsive users-table">
              <table class="table table-striped table-sm data-table">
                <caption id="user_count">
                  {{ trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $branches ->count()]) }}
                </caption>
                <thead class="thead">
                <tr>
                  <th>{!! trans('organization.branch_table.id') !!}</th>
                  <th>{!! trans('organization.branch_table.name') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.email') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.branch_code') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.branch_type') !!}</th>
                  <th class="hidden-xs">{!! trans('organization.branch_table.address') !!}</th>
                  <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.created') !!}</th>
                  <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.updated') !!}</th>
                  <th align="center">{!! trans('usersmanagement.users-table.actions') !!}</th>
                  <th class="no-search no-sort"></th>
                  <th class="no-search no-sort"></th>
                </tr>
                </thead>
                <tbody id="users_table">
                @foreach($branches as $branch)
                  <tr>
                    <td>{{$branch->id}}</td>
                    <td>{{$branch->branch_name}}</td>
                    <td class="hidden-xs"><a href="mailto:{{ $branch->email }}" title="email {{ $branch->email }}">{{ $branch->email }}</a></td>
                    <td class="hidden-xs">{{$branch->branch_code}}</td>
                    <td class="hidden-xs">{{$branch->branch_type}}</td>
                    <td class="hidden-xs">{{$branch->address}}</td>
                    <td class="hidden-xs">{{$branch->created_at}}</td>
                    <td class="hidden-xs">{{$branch->updated_at}}</td>
                    <td class="hidden-sm hidden-xs hidden-md"> </td>
                    <td class="hidden-sm hidden-xs hidden-md"> </td>
                    <td align="center">
                      {!! Form::open(array('url' => 'branch/delete/' . $branch->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                      {!! Form::hidden('_method', 'POST') !!}
                      {!! Form::button(trans('organization.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Branch', 'data-message' => 'Are you sure you want to delete this Branch ?')) !!}
                      {!! Form::close() !!}
                    </td>
                    <td>
                      <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('organization/branch/' . $branch->id) }}" data-toggle="tooltip" title="Show">
                        {!! trans('organization.buttons.show') !!}
                      </a>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('branch/' . $branch->id) }}" data-toggle="tooltip" title="Edit">
                        {!! trans('organization.buttons.edit') !!}
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

              @if(config('usersmanagement.enablePagination'))
                {{ $branches->links() }}
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
  @if ((count($branches) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
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
