<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<title><?= ucfirst(MAINTITLE) ?> <?= (isset($title)) ? ' | '.$title : ''; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="<?= image_check($setting->icon,'setting'); ?>" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?= base_url('assets/') ?>public/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/') ?>public/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
          <?php
    if (isset($css_add) && is_array($css_add)) {
        foreach ($css_add as $css) {
            echo $css;
        }
    } else {
        echo (isset($css_add) && ($css_add != "") ? $css_add : "");
    }
    ?>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
		
		