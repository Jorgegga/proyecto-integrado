@if($texto=Session::get('error'))
<div class="py-12 animate__animated animate__fadeIn">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="overflow-hidden shadow-sm rounded pt-2" style="background-color:#212E36;">
            <div class="p-6 border-b border-gray-200 text-center">
                <p style="color: #C8CDD0">Error: {{$texto}}</p>
            </div>
        </div>
    </div>
</div>
@endif
@if($texto=Session::get('mensaje'))
<div class="py-12 animate__animated animate__fadeIn">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="overflow-hidden shadow-sm rounded pt-2" style="background-color:#212E36;">
            <div class="p-6 border-b border-gray-200 text-center">
                <p style="color: #C8CDD0">{{$texto}}</p>
            </div>
        </div>
    </div>
</div>
@endif
