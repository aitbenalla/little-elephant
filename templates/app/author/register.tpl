{extends file="app/base.tpl"}
{$title = 'Register'}
{block name="content"}

    <h1 class="fw-bold h2">{$title}</h1>

    <div class="row py-4">
        <div class="col-lg-12">
            <form class="row g-3" method="POST" action="/register" enctype="multipart/form-data">
                <div class="col-md-6">
                    {$form->photo}
                </div>
                <div class="col-md-6">
                    {$form->full_name}
                </div>
                <div class="col-md-6">
                    {$form->username}
                </div>
                <div class="col-md-6">
                    {$form->birth_date}
                </div>
                <div class="col-md-6">
                    {$form->email}
                </div>
                <div class="col-md-6">
                    {$form->phone}
                </div>
                <div class="col-md-6">
                    {$form->password}
                </div>
                <div class="col-md-6">
                    {$form->password_repeat}
                </div>
                <div class="col-12">
                    {$form->address}
                </div>
                <div class="col-md-6">
                    {$form->city}
                </div>
                <div class="col-md-6">
                    {$form->country}
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