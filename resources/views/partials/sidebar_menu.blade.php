<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @if(cache('menus_'.cache_key()))
            @foreach(cache('menus_'.cache_key()) as $menu)
                @if($menu->parents->count() > 0)
                    <li class="nav-item menu-open">
                        <a href="{{ $menu->route !== '#' ? route($menu->route) : '#' }}" class="nav-link">
                            <i class="{{ $menu->icon }}"></i>
                            <p>
                                {{ $menu->menu }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach($menu->parents as $parent)
                                <li class="nav-item">
                                    <a href="{{ $parent->route != '#' ? route($parent->route) : '#' }}" class="nav-link">
                                        <i class="{{ $parent->icon }}"></i>
                                        <p>{{ $parent->menu }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @elseif($menu->parents->count() == 0 && !$menu->hasFather && $menu->route !== '#' && $menu->route !== '')
                    <li class="nav-item">
                        <a href="{{ $menu->parents->count() == 0 && $menu->route !== '#' ? route($menu->route) : '#' }}" class="nav-link">
                            @if($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @endif
                            <p>
                                {{ $menu->menu }}
                            </p>
                        </a>
                    </li>
                @endif
            @endforeach
        @endif


    </ul>
</nav>
