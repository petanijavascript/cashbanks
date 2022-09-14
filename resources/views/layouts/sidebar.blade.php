 
<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded --> 
			<ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-light page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="400"> 
				<li class="sidebar-toggler-wrapper" style="margin-bottom:10px;" > 
					<div class="sidebar-toggler"><span></span></div> 
				</li> 
            @if(session()->get('activeParentMenu') === "Master Data")   
                <li class="nav-item start active open">  
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Master Data</span> 
                        <span class="selected"></span>
                        <span class="arrow open"></span>
					</a>
            @else 
				@if(Auth::user()->group_user_id !=4 && Auth::user()->group_user_id !=2)  
                <li class="nav-item start">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Master Data </span> 
                        <span class="arrow"></span>
					</a>
				@endif
            @endif  
					<ul class="sub-menu"> 
                        @foreach(session()->get('listMenu') as $menu)
                            @if($menu['parent_menu_id']===0) 
                                @if(session()->get('activeChildMenu') === $menu['name'])
                                    <li class="nav-item start active open"> 
                                @else
                                    <li class="nav-item start ">           
                                @endif
                                        <a href="{{$menu['link_to']}}"><i class="{{$menu['icon']}}"></i>{{$menu['name']}}</a>
                                    </li> 
                            @endif
                        @endforeach 
					</ul>
				</li> 
                <li class="heading">
					<h3 class="uppercase">Application</h3>
				</li>
                 @foreach(session()->get('listMenu') as $menu) 
                    @if($menu['parent_menu_id']===null && $menu['menu_id']!=0) 
                        @if(session()->get('activeParentMenu') === $menu['name'])
                            <li class="nav-item active open"> 
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="{{$menu['icon']}}"></i>
                                    <span class="title">{{$menu['name']}}</span> 
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                </a>
                        @else
                            <li class="nav-item">  
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="{{$menu['icon']}}"></i>
                                    <span class="title">{{$menu['name']}}</span>  
                                    <span class="arrow"></span>
                                </a>
                        @endif 
                            <ul class="sub-menu"> 
                                @foreach(session()->get('listMenu') as $childMenu)   
                                    @if($childMenu['child_no']!==null && $childMenu['parent_menu_id'] === $menu['menu_id'])
                                        @if(session()->get('activeChildMenu') === $childMenu['name'])
                                            <li class="nav-item active open">    
                                        @else
                                            <li class="nav-item">
                                        @endif         
                                            <a href="{{$childMenu['link_to']}}" class="nav-link ">
                                                <i class="{{$childMenu['icon']}}"></i>
                                                <span class="title">{{$childMenu['name']}}</span> 
                                            </a> 
                                        </li> 
                                    @endif
                                @endforeach 
                            </ul>
                        </li>  
                    @endif
                 @endforeach  
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->