<!-- ========== Left Sidebar Start ========== -->
<!-- USER-TYPE 0-ADMIN 1-EMPLOYEE 2-CUSTOMER -->
<?php $type = $this->session->userdata(UserSession . 'usertype'); ?>
<div class="vertical-menu">
	<div data-simplebar class="h-100">
		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title" key="t-apps">Applications</li>
				<li class="active mm-active">
					<a href="<?=baseURL?>/dashboard.html" class="waves-effect">
						<i class="bx bxs-dashboard"></i>
						<span key="t-calendar">Dashboard</span>
					</a>
				</li>
				<?php if($type=='0'){ ?>
				<li class="active mm-active">
					<a href="<?=baseURLUSER?>/userlist.html" class="waves-effect">
						<i class="bx bxs-dashboard"></i>
						<span key="t-calendar">User</span>
					</a>
				</li>
				<?php } ?>
				<li class="active mm-active">
					<a href="<?=baseURLFILE?>/filelist.html" class="waves-effect">
						<i class="bx bxs-dashboard"></i>
						<span key="t-calendar">Files</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- Sidebar -->
	</div>
</div>
<!-- Left Sidebar End -->