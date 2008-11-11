<?php

define('CUSTOM_TAGS', true);

	$allowedposttags = array ('address' => array (), 
        //Begin Changes for YUI Rich Text Editor
        'em' => array ('style' => array('background-color', 'color', 'text-align')),
        'strong' => array ('style' => array('background-color', 'color', 'text-align')), 
        'span' => array ('style' => array('background-color', 'color', 'text-align')), 
        'p' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'div' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'a' => array ('href' => array (), 'title' => array (), 'rel' => array (), 'rev' => array (), 'target' => array(), 'name' => array ()),
        'font' => array ('color' => array (), 'face' => array (), 'size' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h1' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h2' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h3' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h4' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h5' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h6' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 

        'img' => array ('alt' => array (), 'align' => array (), 'border' => array (), 'height' => array (), 'hspace' => array (), 'longdesc' => array (),
            'vspace' => array (), 'src' => array (), 'width' => array (), 'title' => array(),
            'style' => array('border', 'padding')
        ), 
        'li' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'sub' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'sup' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'u' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'ul' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'ol' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        //End Changes for YUI Rich Text Editor

        'abbr' => array ('title' => array ()), 
        'acronym' => array ('title' => array ()), 
        'b' => array (), 
        'big' => array (), 
        'blockquote' => array ('cite' => array ()), 
        'br' => array (), 
        'button' => array ('disabled' => array (), 'name' => array (), 'type' => array (), 'value' => array ()), 'caption' => array ('align' => array ()), 
        'code' => array (), 
        'col' => array ('align' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array (), 'width' => array ()), 
        'del' => array ('datetime' => array ()), 
        'dd' => array (), 
        'dl' => array (), 
        'dt' => array (), 
        'fieldset' => array (), 
        'form' => array ('action' => array (), 'accept' => array (), 'accept-charset' => array (), 'enctype' => array (), 'method' => array (), 'name' => array (), 'target' => array ()),
        'hr' => array ('align' => array (), 
        'noshade' => array (), 'size' => array (), 'width' => array ()), 
        'i' => array (), 
        'ins' => array ('datetime' => array (), 'cite' => array ()), 
        'kbd' => array (), 
        'label' => array ('for' => array ()), 
        'legend' => array ('align' => array ()), 
        'pre' => array ('width' => array ()), 
        'q' => array ('cite' => array ()), 
        's' => array (), 
        'strike' => array (), 
        'table' => array ('align' => array (), 'bgcolor' => array (), 'border' => array (), 'cellpadding' => array (), 'cellspacing' => array (), 'rules' => array (), 'summary' => array (), 'width' => array ()), 
        'tbody' => array ('align' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array ()), 
        'td' => array ('abbr' => array (), 'align' => array (), 'axis' => array (), 'bgcolor' => array (), 'char' => array (), 'charoff' => array (), 'colspan' => array (), 'headers' => array (), 'height' => array (), 'nowrap' => array (), 'rowspan' => array (), 'scope' => array (), 'valign' => array (), 'width' => array ()),
        'textarea' => array ('cols' => array (), 'rows' => array (), 'disabled' => array (), 'name' => array (), 'readonly' => array ()), 
        'tfoot' => array ('align' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array ()), 
        'th' => array ('abbr' => array (), 'align' => array (), 'axis' => array (), 'bgcolor' => array (), 'char' => array (), 'charoff' => array (), 'colspan' => array (), 'headers' => array (), 'height' => array (), 'nowrap' => array (), 'rowspan' => array (), 'scope' => array (), 'valign' => array (), 'width' => array ()), 
        'thead' => array ('align' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array ()),
        'title' => array (), 'tr' => array ('align' => array (), 'bgcolor' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array ()), 'tt' => array (),
        'var' => array () 
    );

	$allowedtags = array (
        'b' => array (), 
        'blockquote' => array ('cite' => array ()),
	    'code' => array (),
	    'i' => array (),
        'strike' => array (), 

        //Begin Changes for YUI Rich Text Editor
        'em' => array ('style' => array('background-color', 'color', 'text-align')),
        'strong' => array ('style' => array('background-color', 'color', 'text-align')), 
        'span' => array ('style' => array('background-color', 'color', 'text-align')), 
        'p' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'a' => array ('href' => array (), 'title' => array (), 'rel' => array (), 'rev' => array (), 'target' => array(), 'name' => array ()),
        'div' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'font' => array ('color' => array (), 'face' => array (), 'size' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'u' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        //End Changes for YUI Rich Text Editor
	);
?>
