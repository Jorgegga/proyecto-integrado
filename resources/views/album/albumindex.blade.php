<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>

    <x-slot name="cuerpo">
        <section class="row justify-content-center mt-md-4 mb-md-4 mt-sm-4 mb-sm-4">
            <!--<div class="col-10 pr-3">-->
                @foreach($album as $item)
                <div class="card text-white col-md-2 col-sm-3 mr-sm-5 mr-md-5" style="width: 18rem;">
                    <img class="card-img-top" src='{{asset($item->portada)}}' alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->nombre}}</h5>
                    </div>
                </div>
                @endforeach
            <!--</div>-->
        </section>
    </x-slot>
</x-app-layout>
