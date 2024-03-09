<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
<!-- CSS -->
<link href="<?php echo CDN; ?>tabler/dist/css/tabler.min.css" rel="stylesheet" />
<link href="<?php echo CDN; ?>tabler/dist/css/tabler-vendors.min.css?1695847769" rel="stylesheet" />
<link href="<?php echo CDN; ?>css/global.style.css" rel="stylesheet" />

<!-- JAVASCRIPT -->
<script src="<?php echo CDN; ?>tabler/dist/js/tabler.min.js"></script>
<script type="text/javascript" src="<?php echo CDN; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo CDN; ?>js/script.js"></script>

<script type="text/javascript">
    var MANAGE = '<?php echo MANAGE; ?>';
    var CDN = '<?php echo CDN; ?>';
</script>
<?php
    $document = \Library\Factory::getDocument();
    echo \Library\DocumentRenderer::fetchHead($document);
?>