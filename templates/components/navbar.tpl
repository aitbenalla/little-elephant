<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" aria-label="Eleventh navbar example">
    <div class="container">
        <a class="navbar-brand" href="/"><img class="logo" src="/assets/media/logo.png" alt="logo" width="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/authors">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">Posts</a>
                </li>
            </ul>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
            <div class="text-end d-flex justify-content-center">
                {if isset($smarty.session.author)}
                    <div class="dropdown mt-1">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New post</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/signout">Sign out</a></li>
                        </ul>
                    </div>
                    {else}
                    <a href="/login" class="btn btn-outline-primary me-2">Login</a>
                    <a href="/register" class="btn btn-primary me-2">Register</a>
                {/if}
            </div>
        </div>
    </div>
</nav>