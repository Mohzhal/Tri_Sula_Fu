<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../"/>
		<title>HPALNICKEL</title>
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?= base_url('assets/admin/') ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/admin/') ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('<?= base_url('assets/admin/') ?>media/auth/bg1.jpg'); } [data-bs-theme="dark"] body { background-image: url('<?= base_url('assets/admin/') ?>media/auth/bg1-dark.jpg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Signup Welcome Message -->
			<div class="d-flex flex-column flex-center flex-column-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center text-center p-10">
					<!--begin::Wrapper-->
					<div class="card card-flush w-lg-650px py-5">
						<div class="card-body py-15 py-lg-20">
							<!--begin::Title-->
							<h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
							<!--end::Title-->
							<!--begin::Text-->
							<div class="fw-semibold fs-6 text-gray-500 mb-7">Kami tidak menemukan halaman itu</div>
							<!--end::Text-->
							<!--begin::Illustration-->
							<div class="mb-3">
								<img src="<?= base_url('assets/admin/media/notfound.svg') ?>" class="mw-100 mh-300px theme-light-show" alt="" />
							</div>
							<!--end::Illustration-->
							<!--begin::Link-->
							<div class="mb-0">
								<a href="<?= base_url('landing') ?>" class="btn btn-sm btn-primary">Return Home</a>
							</div>
							<!--end::Link-->
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Signup Welcome Message-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "<?= base_url('assets/admin/') ?>";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= base_url('assets/admin/') ?>plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url('assets/admin/') ?>js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>