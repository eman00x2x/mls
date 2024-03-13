<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
<!-- CSS -->
<link href="<?php echo CDN; ?>tabler/dist/css/tabler.min.css" rel="stylesheet" />
<link href="<?php echo CDN; ?>tabler/dist/css/tabler-vendors.min.css?1695847769" rel="stylesheet" />
<link href="<?php echo CDN; ?>css/global.style.css" rel="stylesheet" />
<link href="<?php echo CDN; ?>css/site.style.css" rel="stylesheet" />

<!-- JAVASCRIPT -->
<script src="<?php echo CDN; ?>tabler/dist/js/tabler.min.js"></script>
<script type="text/javascript" src="<?php echo CDN; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo CDN; ?>js/script.js"></script>

<script type="text/javascript">
    var DOMAIN = '<?php echo WEBDOMAIN; ?>';
    var CDN = '<?php echo CDN; ?>';
</script>

<?php

    $document = \Library\Factory::getDocument();
    echo \Library\DocumentRenderer::fetchHead($document);

    echo CONFIG['header_script'];
    echo CONFIG['analytics'];

?>