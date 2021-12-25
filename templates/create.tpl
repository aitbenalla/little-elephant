{extends file="base.tpl"}
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
            <form class="row row-cols-lg-auto g-3 align-items-center" method="post" action="/create"
                  enctype="multipart/form-data">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="postCover" class="form-label">Cover:</label>
                        <input type="file" name="postCover" class="form-control" id="postCover">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="postTitle" name="postTitle"
                               placeholder="Post Title" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="postSlug" class="form-label">Slug:</label>
                        <input type="text" class="form-control" id="postSlug" name="postSlug"
                               placeholder="Post URL" required>
                    </div>
                </div>

                <div class="col-12">
                    <label for="postCategories" class="form-label">Categories:</label>
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
                        <textarea class="form-control" id="postContent" name="postContent" required></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label for="postTags" class="form-label">Tags:</label>
                        <input type="text" class="form-control" id="postTags" name="postTags"
                               placeholder="Add tags">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="postStatus" name="postStatus" checked>
                            <label class="form-check-label" for="postStatus">
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
