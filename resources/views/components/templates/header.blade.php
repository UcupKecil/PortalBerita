<header class="short-header">

   	<div class="gradient-block"></div>

   	<div class="row header-content">

   		<div class="logo">
	         <a href="index.html">Author</a>
	      </div>

	   	<nav id="main-nav-wrap">
				<ul class="main-navigation sf-menu">
					<li class="current"><a href="{{url('/')}}" title="Portal Berita">Home</a></li>
                    <li class="has-children current">
						<a href="{{url('/')}}" title="">Kategori Berita</a>
						<ul class="sub-menu">
                            <!--foreach ambil dari database-->
                            <li><a href="#" title=""></a></li>
                        </ul>
                    </li>
                    <li class="has-children current">
						<a href="{{url('/')}}" title="">Pengelola</a>
						<ul class="sub-menu">
                        <li><a href="{{url('/login')}}" title="">Login</a></li>
                        <li><a href="{{url('/register')}}" title="">Daftar</a></li>
                    </li>
			    </ul>


				</ul>
			</nav> <!-- end main-nav-wrap -->

			<div class="search-wrap">

				<form role="search" method="get" class="search-form" action="#">
					<label>
						<span class="hide-content">Search for:</span>
						<input type="search" class="search-field" placeholder="Type Your Keywords" value="" name="s" title="Search for:" autocomplete="off">
					</label>
					<input type="submit" class="search-submit" value="Search">
				</form>

				<a href="#" id="close-search" class="close-btn">Close</a>

			</div> <!-- end search wrap -->

			<div class="triggers">
				<a class="search-trigger" href="#"><i class="fa fa-search"></i></a>
				<a class="menu-toggle" href="#"><span>Menu</span></a>
			</div> <!-- end triggers -->

   	</div>

   </header>
