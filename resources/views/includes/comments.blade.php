
<div class="row mt-5">


    <div class="col-xl-8">
        <div class="card">

            @if($comments->count() > 0)


                <div class="card-header">
                    <div class="card-title">Comments</div>
                </div>
                <div class="card-body pb-0">

                    @foreach($comments as $comment)
                        <div class="row">
                            <div class="col-2">
                                <a href=""> <img class="m-0 justify-center avatar-xxl avatar rounded-circle"  alt="64x64" src="{{$comment->photo ? $comment->photo : asset('dist/images/hold.jpeg')}}"> </a>
                            </div>
                            <div class="media mb-4 col-9 ">
                                <div class="media-body overflow-visible col-12">
                                    <div class="border mb-4 p-3 br-7">
                                        <nav class="nav float-end">
                                            <div class="dropdown">
                                                <a aria-label="anchor" class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item d-inline-flex align-items-center" href="javascript:void(0)"><i class="fe fe-edit me-2"></i> Edit</a>
                                                    <a class="dropdown-item d-inline-flex align-items-center" href="javascript:void(0)"><i class="fe fe-corner-up-left me-2"></i> Reply</a>
                                                    <a class="dropdown-item d-inline-flex align-items-center" href="javascript:void(0)"><i class="fe fe-flag me-2"></i> Report Abuse</a>
                                                    <a class="dropdown-item d-inline-flex align-items-center" href="javascript:void(0)"><i class="fe fe-trash-2 me-2"></i> Delete</a>
                                                </div>
                                            </div>
                                        </nav>
                                        <h6 class="mt-0 fw-normal">{{$comment->author}}</h6>
                                        <span><i class="fe fe-thumb-up text-danger"></i></span>
                                        <p class="font-13 text-muted">{{$comment->body}}</p>


                                        <div id="mainReply">
                                            {{ html()->form()->class('theFormOfReply')->route('replies.store')->open() }}
                                                        {{ html()->hidden('comment_id', $comment->id) }}
                                                        {{ html()->div()->child(html()
                                                        ->text('reply')->attribute('autocomplete', 'off')->class('col-12')->id('repField'))}}
                                            {{ html()->form()->close() }}
                                        </div>

                                            <div class="row">


                                                <span class="reply col-6">
                                                <a id="cancelButton" href="javascript:void(0);"><span class="mt-2 badge bg-danger-transparent rounded-pill py-2 px-3 d-inline-flex"><i class="fe fe-x-circle mx-1"></i>Cancel</span></a>
                                                <a id="replyButton" href="javascript:void(0);"><span class="mt-2 badge bg-primary-transparent rounded-pill py-2 px-3 d-inline-flex"><i class="fe fe-corner-up-left mx-1"></i>Reply</span></a>
                                                <a id="submitButton" href="javascript:void(0);"><span class="mt-2 badge bg-secondary-transparent rounded-pill py-2 px-3 d-inline-flex"><i class="fe fe-sunrise mx-1"></i>Submit</span></a>
                                                </span>

                                                <span class="text-red-700 col-6 text-right mt-2 fs-17" id="nullError">Please Write Something</span>
                                            </div>
                                    </div>


                                </div>
                            </div>
                        </div>



                    @endforeach

                </div>
        </div>

            @endif

        </div>







        <div class="card">
            <div class="card-header">
                <div class="card-title">Add a Comments</div>
            </div>
            <div class="card-body">
                {{ html()->form('POST')->class('form-horizontal  m-t-20')->route('comments.store')->open() }}
                        {{ html()->hidden('post_id', $post->id) }}
                        {{ html()->div()->class('form-group mb-3')->child(html()
                            ->div()->class('col-xs-12')->child(html()
                            ->textarea('body')->rows(5)->class('form-control'))) }}
                        {{ html()->button('Submit')->class('btn btn-primary btn-rounded  waves-effect waves-light') }}
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>
