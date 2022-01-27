<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            @foreach ($menus as $menu)
                <li class="{{ ($menu->get_child_count != 0 ? 'treeview' : '') }} {{ ($menu->source == explode('\\', $controller)[0] ? 'active' : '') }}">
                    <a href="{{ ($menu->get_child_count != 0 ? '#' : config('app.url').'/'.$menu->link) }}">
                        <i class="{{ $menu->icon }}"></i>
                        <span>{{ $menu->judul }}</span>
                        {!! ($menu->get_child_count != 0 ? '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>' : '') !!}
                    </a>
                    @if($menu->get_child_count != 0)
                        <ul class="treeview-menu">
                            @foreach ($menu->get_child as $child)
                                <li class="{{ ($child->source == $controller ? 'active' : '') }}">
                                    <a href="{{ config('app.url').'/'.$menu->link.'/'.$child->link }}">
                                        <i class="{{ $child->icon }}"></i>
                                        <span>{{ $child->judul }}</span>
                                    </a>                                    
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
</aside>