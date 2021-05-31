<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-sm-12 col-md-8 col-lg-5 my-5">
            <div class="card shadow-sm">
                <div class="card-header" style="background: #86a5b9">
                    <div class="d-flex justify-content-center mb-3 ">
                        {{ $logo }}
                    </div>
                </div>
                <div class="card-body" style="background: #2f3d49">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
