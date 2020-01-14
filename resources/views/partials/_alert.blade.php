<style>

</style>
@if(session('type'))
    <div class="row pop">
        <div class="col-md-12">
            <div class="alert alert-{{ session('type') }}">
                <a href="" class="close" data-dismiss="alert">
                    <i class="fa fa-times-circle fa-1x"></i>
                </a>
                <ul>
                    <li>{!! session('message') !!}</li>
                </ul>
            </div> 
        </div>
    </div>
@endif

@if($errors->any())
    <div class="row pop">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <div class="close">
                    <a href="" class="close" data-dismiss="alert">
                        <i class="fa fa-times-circle fa-1x"></i>
                    </a>
                </div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        <br>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif