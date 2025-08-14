<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">

                </span>
            </span>
            @php
            $headerLogo = business_setting('header_logo');
        @endphp
            @if ($headerLogo) <!-- Check if the logo path exists -->
            <img style="max-width: 150px;" class="img-thumbnail" src="{{ asset('storage/' . $headerLogo) }}" alt="Header Logo Preview"/>
        @else
        <span class="badge bg-label-secondary rounded-pill mb-1"> No logo uploaded yet</span>
        @endif

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z" fill="currentColor" fill-opacity="0.6" />
                <path d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z" fill="currentColor" fill-opacity="0.38" />
            </svg>
        </a>

    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">


        <li class="menu-header mt-2">
            <span class="menu-header-text" data-i18n="MANAGE">MANAGE</span>
        </li>

        <li class="menu-item ">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>

        </li>
        <li class="menu-item {{ Route::currentRouteName()=='admin.leads.list' ? 'active':'' }}  ">
            <a href="{{ route('admin.leads.list') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Leads">Leads</div>
            </a>

        </li>
        {{-- <li class="menu-item {{ Route::currentRouteName() == 'categories' ? 'active' : '' }}">
            <a href="{{ route('categories') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-note-outline"></i>
                <div>Categories</div>
            </a>
        </li> --}}
        <li class="menu-item  {{ Route::currentRouteName()=='admin.contact.list' ? 'active':'' }} ">
            <a href=" {{ route('admin.contact.list') }} " class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-receipt"></i>
                <div data-i18n="Contacts">Contacts</div>
            </a>
        </li>
        <li class="menu-item {{ in_array(Route::currentRouteName(), ['admin.portfolio.categories', 'admin.category.edit']) ? 'active' : '' }} ">
            <a href="{{ route('admin.portfolio.categories') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Portfolio">Portfolio</div>
            </a>

        </li>
        <li class="menu-item {{ in_array(Route::currentRouteName(), ['admin.blog.create','admin.blogs.categories','admin.blog.edit','admin.blog.list','admin.blog.view'.'admin.blog.edit']) ? 'active' : '' }} ">
            <a href="{{ route('admin.blogs.categories') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Blogs">Blogs</div>
            </a>

        </li>
        {{-- <li class="menu-item {{ in_array(Route::currentRouteName(), ['admin.blog.create', 'admin.blog.list','admin.blog.view']) ? 'active open' : '' }} ">

            <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect d-flex ">
                <i class="menu-icon tf-icons mdi mdi-note-outline"></i>

                <div data-i18n="Blogs">Blogs</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::currentRouteName()=='admin.blog.create' ? 'active':'' }} ">
                    <a href="{{ route('admin.blog.create',3) }}" class="menu-link">
                        <div data-i18n="Add">Add</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::currentRouteName()=='admin.blog.list' ? 'active':'' }} ">
                    <a href="{{ route('admin.blog.list',2) }}" class="menu-link">
                        <div data-i18n="List">List</div>
                    </a>
                </li>

            </ul>
        </li> --}}
        <li class="menu-item {{ in_array(Route::currentRouteName(), ['admin.website.appearance','admin.website.theme','admin.website.banner']) ? 'active open' : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect d-flex ">
                <i class="menu-icon tf-icons mdi mdi-note-outline"></i>

                <div data-i18n="Website Setup">Website Setup </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::currentRouteName()=='admin.website.appearance' ? 'active':'' }} ">
                    <a href="{{ route('admin.website.appearance') }}" class="menu-link">
                        <div data-i18n="Apperance">Apperance</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::currentRouteName()=='admin.website.theme' ? 'active':'' }} ">
                    <a href="{{ route('admin.website.theme') }}" class="menu-link">
                        <div data-i18n="Theme">Theme</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::currentRouteName()=='admin.website.banner' ? 'active':'' }} ">
                    <a href="{{ route('admin.website.banner') }}" class="menu-link">
                        <div data-i18n="Banner">Banner</div>
                    </a>
                </li>


            </ul>
        </li>
        <li class="menu-item {{ in_array(Route::currentRouteName(), ['admin.chat.list']) ? 'active' : '' }} ">
            <a href="{{ route('admin.chat.list') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Chat">Chat</div>
            </a>

        </li>


    </ul>
</aside>
<!-- / Menu -->
