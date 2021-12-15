{extends file="base.tpl"}
{$title = 'Authors'}
{block name=content}
    <h1 class="fw-bold h2">Authors:</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 py-4">
            <div class="col">
                <div class="card text-center justify-content-center d-block p-3">
                    <img class="rounded-circle author-img" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Author Name</h5>
                        <p class="text-muted">@Founder <span>| </span><span><a href="#" class="text-pink">email@email.com</a></span></p>
                        <a href="#" class="btn btn-primary">Follow</a>
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>2563</h4>
                                        <p class="mb-0 text-muted">Posts</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>6952</h4>
                                        <p class="mb-0 text-muted">Followers</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>1125</h4>
                                        <p class="mb-0 text-muted">Comments</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
{/block}