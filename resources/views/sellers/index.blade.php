@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('agents.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Agents')}}</a>
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
                        <div class="select" style="min-width: 300px;">
                            <select class="form-control demo-select2" name="approved_status" id="approved_status" onchange="sort_sellers()">
                                <option value="">{{translate('Filter by Approval')}}</option>
                                <option value="1"  @isset($approved) @if($approved =='1') selected @endif @endisset>{{translate('Approved')}}</option>
                                <option value="0"  @isset($approved) @if($approved == '0') selected @endif @endisset>{{translate('Non-Approved')}}</option>
                            </select>
                        </div>
                    </div>
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
                    <th>{{translate('Name')}}</th>                   
                    <th>{{translate('Email Address')}}</th>                   
                    <th>{{translate('Status')}}</th>                  
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sellers as $key => $seller)
                
                        <tr>                         
                            <td>{{ ($key+1) + ($sellers->currentPage() - 1)*$sellers->perPage() }}</td>
                            <td> {{$seller->name}}</td>
                            <td>{{$seller->email}}</td>
                            <td>
                                <label class="switch">
                                    <input onchange="update_approved(this)" value="{{ $seller->id }}" type="checkbox" <?php if($seller->verification_status == 1) echo "checked";?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>                            
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a onclick="show_seller_profile('{{$seller->id}}');">{{translate('Profile')}}</a></li>                                 
                                        <li><a href="{{route('agents.edit', encrypt($seller->id))}}">{{translate('Edit')}}</a></li>                                       
                                        <li><a onclick="confirm_modal('{{route('agents.destroy', $seller->id)}}');">{{translate('Delete')}}</a></li>
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
        function show_seller_profile(id){
            $.post('{{ route('sellers.profile_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#profile_modal #modal-content').html(data);
                $('#profile_modal').modal('show', {backdrop: 'static'});
            });
        }

        function update_approved(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('sellers.approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Approved sellers updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function sort_sellers(el){
            $('#sort_sellers').submit();
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
                    <p>{{translate('Do you really want to ban this seller?')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{translate('Cancel')}}</button>
                    <a id="confirmation" class="btn btn-danger btn-ok">{{translate('Proceed!')}}</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="confirm-unban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">{{translate('Confirmation')}}</h4>
                </div>

                <div class="modal-body">
                    <p>{{translate('Do you really want to unban this seller?')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{translate('Cancel')}}</button>
                    <a id="confirmationunban" class="btn btn-success btn-ok">{{translate('Proceed!')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection