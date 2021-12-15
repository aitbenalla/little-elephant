{extends file="base.tpl"}
{$title = 'Posts'}
{block name="content"}
    <h1 class="h2">Posts:</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4 py-4">
        <div class="col">
            <div class="card mb-3">
                <img src="/assets/media/post.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Post title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                        <a href="#" class="float-end">Continue reading →</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3">
                <img src="/assets/media/post.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Post title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                        <a href="#" class="float-end">Continue reading →</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3">
                <img src="/assets/media/post.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Post title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                        <a href="#" class="float-end">Continue reading →</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
{/block}