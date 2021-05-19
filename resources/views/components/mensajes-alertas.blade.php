@if($texto=Session::get('error'))
<div class="py-12 alert alert-dismissible animate__animated animate__fadeIn" role="alert">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="overflow-hidden shadow-sm rounded pt-2" style="background-color:#212E36;">
            <div class="p-6 border-b border-gray-200 text-center">
                <p style="color: #C8CDD0">Error: {{$texto}}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
    </div>
</div>
@endif
@if($texto=Session::get('mensaje'))
<div class="py-12 alert alert-dismissible animate__animated animate__fadeIn" role="alert">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="overflow-hidden shadow-sm rounded pt-2" style="background-color:#212E36;">
            <div class="p-6 border-b border-gray-200 text-center">
                <p style="color: #C8CDD0">{{$texto}}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>

        </div>

    </div>

</div>
@endif
