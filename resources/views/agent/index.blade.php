@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('agent.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Account')}}</a>
        </div>
    </div>

    <br>

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{translate('Agents')}}</h3>
            <div class="pull-right clearfix">
                <form class="" id="sort_sellers" action="" method="GET">                  
                    <div class="box-inline pad-rgt pull-left">
                        <div class="" style="min-width: 200px;">
                            <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name or email & Enter') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('name')}}</th>           
                    @if(Auth::user()->user_type=='admin')        
                    <th>{{translate('Agentname')}}</th>
                    @endif
                    <th>{{translate('bankname')}}</th>
                    <th>{{translate('Account No')}}</th> 
                    <th>{{translate('Ifsc')}}</th>                                                 
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sellers as $key => $seller)
                
                        <tr>                         
                            <td>{{ ($key+1) + ($sellers->currentPage() - 1)*$sellers->perPage() }}</td>
                            <td> {{$seller->name}}</td>
                            @if(Auth::user()->user_type=='admin')        
                            <td>{{$seller->fathername}}</td>
                            @endif
                            <td> {{$seller->bankname}}</td>
                            <td> {{$seller->account}}</td>
                            <td>{{$seller->ifsc}}</td>                                               
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                       @if(Auth::user()->user_type=='admin')
                                        <li><a href="#" onclick="confirm_ban('{{route('accounts.approved', $seller->id)}}');">{{translate('Approved this Accounts')}}  <i class="fa fa-check text-success" aria-hidden="true"></i> </a></li>    
                                        <li><a href="{{route('agent.edit', encrypt($seller->id))}}">{{translate('edit')}}</a></li>
                                        @endif
                                        <li><a href="{{route('agent.show', encrypt($seller->id))}}">{{translate('Show')}}</a></li>   
                                        <li><a onclick="confirm_modal('{{route('agent.destroy', $seller->id)}}');">{{translate('Delete')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $sellers->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
         function confirm_ban(url)
        {
            $('#confirm-ban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmation').setAttribute('href' , url);
        }

    </script>
@endsection

@section('modal')
    <div class="modal fade" id="confirm-ban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">{{translate('Confirmation')}}</h4>
                </div>

                <div class="modal-body">
                    <p>{{translate('Do you really want to Approve this Account?')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{translate('Cancel')}}</button>
                    <a id="confirmation" class="btn btn-danger btn-ok">{{translate('Proceed!')}}</a>
                </div>
            </div>
        </div>
    </div>

@endsection