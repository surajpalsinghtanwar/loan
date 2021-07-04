<div class="panel">
    <div class="panel-body">
        <div class="">
            <!-- Simple profile -->
            <div class="text-center">
                <div class="pad-ver">
                    <img src="{{ my_asset($seller->avatar) }}" class="img-lg img-circle" alt="Profile Picture">
                </div>
                <h4 class="text-lg text-overflow mar-no">{{ $seller->name }}</h4>               
            </div>
            <hr>

            <!-- Profile Details -->
            <p class="pad-ver text-main text-sm text-uppercase text-bold">{{translate('About')}} {{ $seller->name }}</p>
            <p><i class="demo-pli-old-telephone icon-lg icon-fw"></i>{{ $seller->phone }}</p>
             <p><i class="demo-pli-old-address icon-lg icon-fw"></i>{{ $seller->address }}</p>
            <br>
        </div>
    </div>
</div>
