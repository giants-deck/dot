@vite('resources/js/app.js')



<div class="row authentication coming-soon mx-0 justify-content-center">

    <div class="col-xxl-8 col-xl-8 col-lg-8 col-12">
        <div class="authentication-cover text-fixed-white">
            <div class="aunthentication-cover-content text-center py-5 px-sm-5 px-0">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-xxl-6 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                        <h1 class="display-3 text-fixed-white">You're not an ADMIN</h1>
                        <div class="m-4">
                                <span class="fs-20 fw-semibold">
                                        OOPS! You don't have the permission
                                </span>
                            <p class="fs-16">Go back to your DASHBOARD</p>
                        </div>
                        <div class="text-center">
                            <a class="btn btn-secondary d-inline-flex gap-1" href="{{route('dashboard')}}"> <i class="ri-arrow-left-line my-auto "></i> Back to Home </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
