<?php
    function auto_version($file)
    {
        if(strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
        return $file;
    
        $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
        return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
    }
?>

<!-- Personal Css -->
<?php

    if (isset($settings) && !empty($settings)) {
        $theme = $settings['theme'];
    } else{
        $theme = 'Light';
    }
    
    switch ($theme) {
        case 'Light':

?>
    <!-- Light Theme Css File -->
    <link rel="stylesheet" type="text/css" href="<?php echo auto_version('/Websites/mitunes/Css/light.css'); ?>" />
<?php

    break;

    case 'Dark':

?>
    <!-- Dark Theme Css File -->
    <link rel="stylesheet" type="text/css" href="<?php echo auto_version('/Websites/mitunes/Css/dark.css'); ?>" />
<?php

    break;

    default:

?>
    <!-- Light Theme Css File -->
    <link rel="stylesheet" type="text/css" href="<?php echo auto_version('/Websites/mitunes/Css/light.css'); ?>" />
<?php

    break;

    }
?>








<!-- External Css Links -->
<link rel="stylesheet" type="text/css" href="/Websites/mitunes/Css/materialize.css" />
<link rel="stylesheet" type="text/css" href="/Websites/mitunes/Css/materialize.min.css" />


<!-- External Fonts-->
<link href="/Websites/mitunes/Css/material_fonts.css" rel="stylesheet">
<link href="/Websites/mitunes/Fonts/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet">