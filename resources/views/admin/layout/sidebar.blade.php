<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/categories') }}"><i class="nav-icon icon-folder"></i> {{ trans('admin.category.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/tabs') }}"><i class="nav-icon icon-menu"></i> {{ trans('admin.tab.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/applications') }}"><i class="nav-icon icon-puzzle"></i> {{ trans('admin.application.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/pages') }}"><i class="nav-icon icon-bubble"></i> {{ trans('admin.page.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/uploads') }}"><i class="nav-icon icon-cloud-upload"></i> {{ trans('admin.upload.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/settings') }}"><i class="nav-icon icon-settings"></i> {{ trans('admin.setting.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
