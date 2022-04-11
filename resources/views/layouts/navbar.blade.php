<!DOCTYPE html>
<html lang="en">
<head>

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="">

    @include('layouts.header')

</head>
<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse" style="background-color: #E0D5BB;">
		<div class="navbar-header">
			<a class="navbar-brand" href="/admin"><img src="" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<div class="navbar-right">
				<p class="navbar-text">Welcome, {{ Auth::user()->name }}!</p>
				<p class="navbar-text"><span class="label bg-success-400">Online</span></p>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-default">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user-material">
						<div class="category-content">
							<div class="sidebar-user-material-content">
								<h6>{{ Auth::user()->name }}</h6>
								<span class="text-size-small"></span>
							</div>

							<div class="sidebar-user-material-menu">
								<a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
							</div>
						</div>

						<div class="navigation-wrapper collapse" id="user-nav">
							<ul class="navigation">
								{{-- <li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
								<li><a href="#"><i class="icon-coins"></i> <span>My balance</span></a></li>
								<li><a href="#"><i class="icon-comment-discussion"></i> <span><span class="badge bg-teal-400 pull-right">58</span> Messages</span></a></li>
								<li class="divider"></li>
								<li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li> --}}
								<li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();$('#logout-form').submit();">
                                        <i class="icon-switch2"></i> <span>Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
							</ul>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								{{-- <li class="navigation-header"><span>Main</span>
                                    <i class="icon-menu" title="Main pages"></i>
                                </li> --}}

                                {{-- Dashboard --}}
								<li>
                                    <a href="/admin">
                                        <i class="icon-home2"></i><span>Dashboard</span>
                                    </a>
                                </li>

                                {{-- News --}}
                                <li>
									<a href="#"><i class="icon-basket"></i> <span>News</span></a>
									<ul>
										<li><a href="/admin/news"><i class="icon-box"></i>List News</a></li>
									</ul>
								</li>

								{{-- Project --}}
                                <li>
									<a href="#"><i class="icon-basket"></i> <span>Project</span></a>
									<ul>
										<li><a href="/admin/kategori-project"><i class="icon-box"></i>List Kategori Project</a></li>
										<li><a href="/admin/project"><i class="icon-box"></i>List Project </a></li>
									</ul>
								</li>

							</ul>
						</div>
					</div>
					<!-- /main navigation -->
				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="/admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="navbar_colors.html">@yield('breadcrumb')</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

                    {{-- Template Panel --}}
                    @yield('content')

					<!-- Footer -->
					<div class="footer text-muted">
						PROSERA <i class="icon-x"></i> <a href="https://www.instagram.com/larv.studio/" class="text-muted">LARVSTD</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

    @yield('javascript')

</body>
</html>
