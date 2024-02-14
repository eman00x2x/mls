<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>

<link href="<?php echo CDN; ?>css/global.style.css" rel="stylesheet" />

<!-- JAVASCRIPT -->
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