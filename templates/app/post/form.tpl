{extends file="app/base.tpl"}
{$title = 'Create New Post'}

{block name="stylesheets"}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
{/block}

{block name="javascripts"}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
    <script src="/assets/js/post.js"></script>
{/block}
{block name="content"}
    <h1 class="fw-bold h2">{$title}:</h1>
    <div class="row py-4">
        <div class="col-lg-12">
            <form class="row row-cols-lg-auto g-3 align-items-center" method="post" action="/post/new"
                  enctype="multipart/form-data">
                <div class="col-12">
                    <div class="mb-3">
                        {$form->cover}
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        {$form->title}
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        {$form->slug}
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        {$form->categories}
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        {$form->content}
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        {$form->tags}
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                            <label class="form-check-label" for="status">
                                Publish
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center border-top p-4">
                    <button type="submit" name="postIt" class="btn btn-primary">Post!</button>
                </div>
            </form>
        </div>
    </div>
{/block}
