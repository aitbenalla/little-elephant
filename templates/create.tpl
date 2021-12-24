{extends file="base.tpl"}
{$title = 'Create New Post'}
{block name="stylesheets"}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
{/block}

{block name="javascripts"}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="/assets/js/post.js"></script>
{/block}
{block name="content"}
    <div class="card mt-4 mb-4">
        <h5 class="card-header">{$title}</h5>
        <div class="card-body p-4">
            <form class="row row-cols-lg-auto g-3 align-items-center" method="post" action="/create" enctype="multipart/form-data">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="postCover" class="form-label">Cover</label>
                        <input type="file" name="postCover" class="form-control" id="postCover">
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle" name="postTitle"
                               placeholder="Example input placeholder" required>
                    </div>
                </div>

                <div class="col-12">
                    <label for="postCategories" class="form-label">Categories</label>
                    <select class="form-select" id="postCategories" name="postCategories" required>
                        <option selected>Choose...</option>
                        {foreach from=$categories item=category}
                            <option value="{$category->getId()}">{$category->getName()|capitalize}</option>
                        {/foreach}
                    </select>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Content</label>
                        <textarea id="postContent" name="postContent" required></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" name="postIt" class="btn btn-primary float-end">Post!</button>
                </div>
            </form>
        </div>
    </div>
{/block}
