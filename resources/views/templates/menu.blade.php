<div class="sidebar-menu">
	<div class="sidebar-menu-inner">

		<header class="logo-env">
			<div class="logo">
				<a href="/dashboard">
                    <img src="{{ asset('images/logo/' . $setting->logo) }}" width="155" alt="tirtasanitaresort" />
				</a>
			</div>
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>

		<div class="sidebar-user-info">
			<div class="sui-normal">
				<a href="#" class="user-link">
					<img src="{{asset('/user/'.Auth::user()->img)}}" width="55" alt="" class="img-circle" style="margin-right: 5px !important;" />
					<span style="margin-top: 10px;">{{Auth::user()->name}}<i class="fa fa-chevron-right pull-right"></i></span>
				</a>
			</div>
			<div class="sui-hover inline-links animate-in">
				<span class="close-sui-popup">&times;</span>
				<li>
					<a href="/main_page/account/edit/{{Crypt::encryptString(Auth::user()->id)}}/1">
						<i class="entypo-user"></i>
						<span class="title" style="">My Account</span>
					</a>
				</li>
			</div>
		</div>

		{{-- <div class="marginsidebar"> --}}
		<ul id="main-menu" class="main-menu mb">

			{{-- DASHBOARD --}}
			{{-- <div class="marginbottom"> --}}
			<li>
				<a  href="/dashboard" >

                    <i class="fa fa-fw fa-home"></i>
                    <span class="title">Dashboard</span>

				</a>
			</li>
			{{-- </div> --}}
			{{-- RESERVATION --}}
			{{-- <div class="marginbottom"> --}}
            <li>
                <a  href="/main_page/reservation">

                    <i class="fa fa-fw fa-list"></i>
                        <span class="title">Reservation</span>

                </a>
			</li>
			{{-- </div> --}}
			{{-- ALLOTMENT --}}
			{{-- <div class="marginbottom"> --}}
			@if(Auth::user()->level == 0 || Auth::user()->level == 1)
			<li>
				<a  href="/main_page/allotment">

                    <i class="fa fa-fw fa-building-o"></i>
                    <span class="title">Allotment</span>

				</a>
			</li>
			@endif
			{{-- </div> --}}
			{{-- MASTER DATA --}}
			{{-- <div class="marginbottom"> --}}
			@if(Auth::user()->level == 0)
			<li>
				<a  href="#">

                    <i class="fa fa-fw fa-server"></i>
                    <span class="title">Master Data</span>

				</a>
				<ul>
					<li>
						<a  href="/master_data/banner">

                            <i class="entypo-doc-landscape"></i>
                            <span class="title">Banner</span>

						</a>
					</li>
					<li>
						<a  href="/master_data/news">

                            <i class="entypo-newspaper"></i>
                            <span class="title">News</span>

						</a>
					</li>
					<li>
						<a  href="/master_data/room">

                            <i class="fa fa-fw fa-bed"></i>
                            <span class="title">Rooms</span>

						</a>
					</li>
					<li>
						<a  href="/master_data/amenities">

                            <i class="fa fa-fw fa-diamond"></i>
                            <span class="title">Amenities</span>

						</a>
					</li>
					<li>
						<a  href="/master_data/package">

                            <i class="entypo-bag"></i>
                            <span class="title">Package</span>

						</a>
					</li>
					<li>
						<a  href="/master_data/function_room">

                            <i class="fa fa-magic" style="padding-right: 5px; padding-left: 5px;"></i>
                            <span class="title">Function Room</span>

						</a>
					</li>
				</ul>
			</li>
			@endif
			{{-- </div> --}}
			{{-- REPORT --}}
			{{-- <div class="marginbottom"> --}}
			@if(Auth::user()->level == 0 || Auth::user()->level == 1)
			<li>
				<a  href="#">

                    <i class="fa fa-fw fa-file-text-o"></i>
                    <span class="title">Report</span>

				</a>
				<ul>
					<li>
						<a  href="/main_page/report">

                            <i class="fa fa-pie-chart"></i>
                            <span class="title">Sales Report</span>

						</a>
					</li>
					<li>
						<a  href="/main_page/reservation_report">

                            <i class="fa fa-bar-chart"></i>
                            <span class="title">Reservation Report</span>

						</a>
					</li>
					<li>
						<a  href="/main_page/customer_report">

                            <i class="fa fa-area-chart"></i>
                            <span class="title">Customer Report</span>

						</a>
					</li>
					<li>
						<a  href="/main_page/allotment_report">

                            <i class="fa fa-line-chart"></i>
                            <span class="title">Allotment Report</span>

						</a>
					</li>
				</ul>
			</li>
			@endif
			{{-- </div> --}}
			{{-- ACCOUNT --}}
			{{-- <div class="marginbottom"> --}}
			@if(Auth::user()->level == 0)
			<li>
				<a  href="/main_page/account">

                    <i class="fa fa-fw fa-users"></i>
                    <span class="title">Account</span>

				</a>
            </li>

            <li>
				<a  href="#">
                    <i class="fa fa-fw fas fa-cog"></i>
                    <span class="title">Setting</span>

				</a>
				<ul>
					<li>
						<a href="/main_page/setting">
                            <i class="fa fa-fw fas fa-cog"></i>
                            <span class="title">Setting</span>
						</a>
                    </li>
                    <li>
						<a href="/main_page/page_setting">
                            <i class="fa fa-fw fa-file"></i>
                            <span class="title">Page Setting</span>
						</a>
                    </li>
                </ul>
            </li>


            {{-- <li>
				<a href="/main_page/setting">
                    <i class="fa fa-fw fas fa-cog"></i>
                    <span class="title">Setting</span>
				</a>
			</li> --}}
			@endif
			{{-- </div> --}}
			{{-- LOGOUT --}}
			{{-- <div class="marginbottom"> --}}
			<li>
				<a  href="/logout">

                    <i class="fa fa-fw fa-sign-out"></i>
                    <span class="title">Logout</span>

				</a>
			</li>
			{{-- </div> --}}

		</ul>
		{{-- </div> --}}

	</div>
</div>
