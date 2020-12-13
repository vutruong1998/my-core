<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/"><img src="images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="/"><img src="images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @php 
                    $configLayouts = config('mc_layouts.main') ?? [];
                @endphp
                @foreach ($configLayouts as $key => $value)
                    @php 
                        $perms = $value['permissions'] ?? [];
                        $permissions = \MyCore\Core\Models\Permission::where('guard_name', 'web')->pluck('name')->toArray();
                        $currentRoute = \Route::currentRouteName();
                    @endphp
                    @if(!isset($value['children']))
                    <li>
                        <a class="{{ checkActiveMenu($currentRoute, $value['route_action']) }}" 
                        href="{{ !empty($value['route_action']) ? route("{$value['route_action']}") : "#" }}"> 
                            <i class="menu-icon fa fa-dashboard"></i>
                            {!! $value['text'] ?? "" !!}
                        </a>
                    </li>
                    @else
                    <li class="menu-item-has-children dropdown {{ checkShowDropdown($currentRoute, $perms) }}">
                        <a href="{{ !empty($value['route_action']) ? route("{$value['route_action']}") : '#' }}" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false"
                            > 
                            <i class="menu-icon fa fa-th"></i>{!! $value['text'] ?? "" !!}
                        </a>
                        @if(isset($value['children']) && !empty($value['children']))
                            <ul class="sub-menu children dropdown-menu {{ checkShowDropdown($currentRoute, $perms) }}">
                                @foreach ($value['children'] as $val)
                                    <li><i class="menu-icon fa fa-th"></i>
                                        @if(isset($val['permission']) && !empty($val['permission']))
                                            @can($val['permission'])
                                            <a class="{{ checkActiveMenu($currentRoute, $val['route_action']) }}" href="{{ !empty($val['route_action']) ? route("{$val['route_action']}") : '#' }}">
                                                {!! $val['text'] ?? "" !!}
                                            </a>
                                            @endcan
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
</aside>