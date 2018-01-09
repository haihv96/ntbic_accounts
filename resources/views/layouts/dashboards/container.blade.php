<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">
                        @yield('linkage.heading.first')</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>@yield('linkage.heading.second')</span>
                </li>
                <li>
                    <span>@yield('linkage.heading.third')</span>
                </li>
            </ul>
        </div>
        <h1 class="page-title"> @yield('page_title')
            <small>@yield('page_title.small')</small>
        </h1>
        <div class="row">
            <div class="col-md-12">
                @yield('container')
            </div>
        </div>
    </div>
</div>