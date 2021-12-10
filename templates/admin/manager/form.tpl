{extends file="base.tpl"}
{$title = 'Add New Admin'}
{block name=content}
    {if isset($admin)}
        <h1 class="fw-bold h2">Edit Admin:</h1>
    {else}
        <h1 class="fw-bold h2">Add Admin:</h1>
    {/if}
    <div class="row p-3">
        <div class="col-lg-12">
            <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
                <div class="col-md-6">
                    <label for="inputPhoto" class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control" id="inputPhoto" disabled>
                </div>
                <div class="col-md-6">
                    <label for="inputFullName" class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" id="inputFullName" {if isset($admin)}value="{$admin->getFullName()}"{/if}>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" {if isset($admin)}value="{$admin->getEmail()}"{/if} required>
                </div>
                <div class="col-md-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" required>
                </div>
                <div class="col-md-3">
                    <label for="inputPasswordRepeat" class="form-label">Repeat Password</label>
                    <input type="password" name="password_repeat" class="form-control" id="inputPasswordRepeat" required>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" name="check" type="checkbox" id="gridCheck" required>
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12 text-center border-top p-4">

                    <button type="submit" name="save" class="btn btn-primary">Save</button>

                </div>
            </form>
        </div>
    </div>
{/block}