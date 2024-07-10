
<?php include_once("header.php"); ?>
<?php include_once("sidemenu.php"); ?>
<?php echo $content; ?>
<!-- The Modal -->
<div id="modal_preview_all" class="preview_modal">
  <span class="preview_close">&times;</span>
  <img class="preview-modal-content showin" id="preview_image">
  <iframe class="preview-modal-content hidin" id="preview_embed" width="656" height="369" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
  <div id="preview_caption"></div>
</div>
<?php include_once("footer.php"); ?>
