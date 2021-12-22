{extends file="base.tpl"}
{$title = $smarty.session.author->getUsername()|capitalize}

{block name="stylesheets"}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
{/block}

{block name="javascripts"}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="/assets/js/post.js"></script>
{/block}


{block name="content"}
{*    <h1 class="fw-bold h2">Profile:</h1>*}
    <div class="row">
        <div class="col-12">
            <div class="p-3 mb-4 bg-light rounded-3">
                <div class="container text-center">
                    <img class="rounded-circle" src="data:image/png;base64,{$smarty.session.author->name|base64_encode}" alt="" width="170" height="170">
                    <h1 class="display-5 fw-bold">{$smarty.session.author->getFullName()|capitalize}</h1>
                    <p class="text-muted text-regular">Themes built by or reviewed by Bootstrap's creators.</p>
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
                                    <p class="mb-0 text-muted">Following</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card mt-4">
                        <h5 class="card-header">Create Post</h5>
                        <div class="card-body p-4">
                            <form class="row row-cols-lg-auto g-3 align-items-center">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="formGroupExampleInput" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                               placeholder="Example input placeholder">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="formGroupExampleInput" class="form-label">Categories</label>
                                    <select class="form-select" id="formGroupExampleInput">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="text-editor" class="form-label">Content</label>
                                        <div id="standalone-container">
                                            <div id="toolbar-container">
                                <span class="ql-formats">
                                  <select class="ql-font"></select>
                                  <select class="ql-size"></select>
                                </span>
                                                <span class="ql-formats">
                                  <button class="ql-bold"></button>
                                  <button class="ql-italic"></button>
                                  <button class="ql-underline"></button>
                                  <button class="ql-strike"></button>
                                </span>
                                                <span class="ql-formats">
                                  <select class="ql-color"></select>
                                  <select class="ql-background"></select>
                                </span>
                                                <span class="ql-formats">
                                  <button class="ql-script" value="sub"></button>
                                  <button class="ql-script" value="super"></button>
                                </span>
                                                <span class="ql-formats">
                                  <button class="ql-header" value="1"></button>
                                  <button class="ql-header" value="2"></button>
                                  <button class="ql-blockquote"></button>
                                  <button class="ql-code-block"></button>
                                </span>
                                                <span class="ql-formats">
                                  <button class="ql-list" value="ordered"></button>
                                  <button class="ql-list" value="bullet"></button>
                                  <button class="ql-indent" value="-1"></button>
                                  <button class="ql-indent" value="+1"></button>
                                </span>
                                                <span class="ql-formats">
                                  <button class="ql-direction" value="rtl"></button>
                                  <select class="ql-align"></select>
                                </span>
                                                <span class="ql-formats">
                                  <button class="ql-link"></button>
                                  <button class="ql-image"></button>
                                  <button class="ql-video"></button>
                                  <button class="ql-formula"></button>
                                </span>
                                                <span class="ql-formats">
                                  <button class="ql-clean"></button>
                                </span>
                                            </div>
                                            <div id="editor-container" style="height: 320px"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                        <label class="form-check-label" for="inlineFormCheck">
                                            Remember me
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"></div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"></div>
            </div>
        </div>
    </div>

{/block}