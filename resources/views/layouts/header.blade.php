<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner"> 
		<div class="page-logo">
            <a href=""><img src="{{asset('global/img/logo-header.png')}}" alt="logo" height="45px"/></a>
			<div class="menu-toggler sidebar-toggler hide"></div>
		</div> 
			
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"><span></span></a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">  
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile">
                            {{Auth::user()->email}}
                        </span>
                        <i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default"> 
						<li>
							<a data-toggle="modal" href="#change_pass_modal"><i class="icon-user"></i> Change Password </a> 
						</li>
						@if (session('bypassAccess')) 
							<li>
								<a href="https://login.ciputra.com/index.php/home/dashboard_group#"><i class="icon-home"></i> Group Dashboard </a>
							</li>
						@endif
                        <li>
							<a href="{{url('/logout')}}"><i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->  
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->

<!-- HIDDEN MODAL FOR CHANGE PASSWORD --> 
<div id="change_pass_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{url('changepassword')}}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><strong>Change Password</strong></h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:170px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                            <div class="col-md-12">
                                <h4>Insert new password</h4>
                            <p>
                                <input type="password" class="col-md-12 form-control" name="new_password">
                            </p> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Confirm your new password</h4>
                            <p>
                                <input type="password" class="col-md-12 form-control" name="confirm_password">
                            </p> 
                        </div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                <input type="submit" class="btn green" value="submit"/> 
            </div> 
            </form>
        </div>
    </div>
</div> 




