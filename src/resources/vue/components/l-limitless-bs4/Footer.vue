<template>

    <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                <i class="icon-unfold mr-2"></i>
                Footer
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
            <span class="navbar-text">
                &copy; 2012 - 2021. {{$root.system.name}}
            </span>

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item"><a href="/support" class="navbar-nav-link" target="_blank"><i class="icon-info22 mr-2"></i> Support</a></li>
                <li class="nav-item"><a href="/docs" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
                <li class="nav-item"><a href="/purchase" class="navbar-nav-link font-weight-semibold"><span class="text-success-700"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li>
            </ul>
        </div>
    </div>

</template>

