@extends('layouts.base')

@section('docName')
    Media
@stop

@section('jQuery')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{asset('dist/js/dropify.min.js')}}"></script>
@stop

@section('style')
    <link rel="stylesheet" href="{{asset('dist/css/dropify.min.css')}}" type="text/css">
@stop

@section('content')
    <div class="row">
        <div class="col-6 display-6">Media</div>
        <div class="col-6">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#exampleModalScrollable2">
                Create Media
            </button>
        </div>

            <div class="modal fade" id="exampleModalScrollable2" tabindex="-1"
                 aria-labelledby="exampleModalScrollable2" data-bs-keyboard="false"
                 aria-hidden="true">
                <!-- Scrollable modal -->
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="staticBackdropLabel2">Create Media</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ html()->form('POST')->id('mediaForm')->route('media.store')->acceptsFiles()->open() }}
                                {{html()->file('path')->class('dropify fs-12')}}
                            {{ html()->form()->close() }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                    data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="mediaSubmit" class="btn btn-info">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="row col-xl-12 mt-3">

            @foreach($photos as $photo)
            <div class="col-xl-4">
                <div class="card border border-secondary custom-card">
                    <div class="card-body">
                        <img height="70" src="{{$photo->path}}" alt="">
                        {{ html()->form('DELETE')->class('mt-3 float-end')->route('media.destroy', $photo->id)->open() }}
                            {{ html()->button('Delete Media')->class('btn btn-danger') }}
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
            @endforeach

    </div>
@stop

@section('scripts')
    <script>
        $('#mediaCreate').click(function (){
            $('#exampleModalCenter').modal('show')
        });

        $('.dropify').dropify();
    </script>

    <script>
        let mButton = document.getElementById('mediaSubmit');
        let mForm = document.getElementById('mediaForm');

        mButton.addEventListener('click', function (){
            mForm.submit();
        })
    </script>
@stop
