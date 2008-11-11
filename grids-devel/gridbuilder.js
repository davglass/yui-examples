
var txt = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.';

YAHOO.CSSGridBuilder = function() {
}

YAHOO.CSSGridBuilder.init = function() {
    this.headerStr = 'YUI: CSS Grid Builder';
    this.footerStr = 'Footer is here.';
    this.headerDefault = this.headerStr;
    this.footerDefault = this.footerStr;
    this.type = 'yui-t7';
    this.docType = 'doc';
    this.rows = [];
    this.rows[0] = $('splitBody0');
    this.storeCode = false;
    this.sliderData = false;

    this.bd = $('bd');
    this.doc = $('doc');
    this.template = $('which_grid');

    $E.addListener(this.template, 'change', YAHOO.CSSGridBuilder.changeType, YAHOO.CSSGridBuilder, true);
    $E.addListener('show_code', 'click', YAHOO.CSSGridBuilder.showCode, YAHOO.CSSGridBuilder, true);
    $E.addListener('setHeader', 'click', YAHOO.CSSGridBuilder.setHeader, YAHOO.CSSGridBuilder, true);
    $E.addListener('setFooter', 'click', YAHOO.CSSGridBuilder.setFooter, YAHOO.CSSGridBuilder, true);
    $E.addListener('splitBody0', 'change', YAHOO.CSSGridBuilder.splitBody, YAHOO.CSSGridBuilder, true);
    $E.addListener('which_doc', 'change', YAHOO.CSSGridBuilder.changeDoc, YAHOO.CSSGridBuilder, true);
    $E.addListener('addRow', 'click', YAHOO.CSSGridBuilder.addRow, YAHOO.CSSGridBuilder, true);
    $E.addListener('resetBuilder', 'click', YAHOO.CSSGridBuilder.reset, YAHOO.CSSGridBuilder, true);
    $E.addListener('about', 'click', YAHOO.CSSGridBuilder.about, YAHOO.CSSGridBuilder, true);
    $E.addListener(this.bd, 'mouseover', YAHOO.CSSGridBuilder.mouseOver, YAHOO.CSSGridBuilder, true);
    $E.addListener(this.bd, 'contextmenu', YAHOO.CSSGridBuilder.dblClick, YAHOO.CSSGridBuilder, true);



    this.tooltip = new YAHOO.widget.Tooltip('classPath', { context: 'bd', showDelay:500 } );

}
YAHOO.CSSGridBuilder.about = function(ev) {
    showAbout = new YAHOO.widget.Dialog('showAbout', {
            close: true,
            modal: true,
            visible: true,
            fixedcenter: true,
            height: '250px',
            width: '250px',
            zindex: 9001
        }
    );
    showAbout.setHeader('CSSGridBuilder About');
    content = '<p>Written by Dav Glass &lt;dav.glass@yahoo.com&gt;</p>';
    content += '<p><a href="http://blog.davglass.com/">blog.davglass.com</a></p>';
    content += '<p>The Grids Builder is designed to work with the Yahoo User Interface (YUI)  CSS Grids tools. They are freely available and you can download a copy from their developer site here:<br><a href="http://developer.yahoo.com/yui/grids" target="_blank">http://developer.yahoo.com/yui/grids</a></p>';
    showAbout.setBody('<b>CSS Grid Builder v 0.5</b>' + content);
    showAbout.render(document.body);
    $E.stopEvent(ev);
}
YAHOO.CSSGridBuilder.dblClick = function(ev) {
    var tar = $E.getTarget(ev);
    console.log('Body DoubleClicked');
    console.log(tar);
    if (tar.tagName.toLowerCase() == 'p') {
        console.log('Show Split Overlay');
        str = $T.printf(this.splitBodyTemplate(4), '<p>' + txt + '</p>');
        tar.parentNode.innerHTML = str;
        //tar.parentNode.removeChild(tar);
        //this.doTemplate();
        $E.stopEvent(ev);
    }
}
YAHOO.CSSGridBuilder.reset = function(ev) {
    for (var i = 1; i < this.rows.length; i++) {
        if (this.rows[i]) {
            if ($('splitBody' + i)) {
                $('splitBody' + i).parentNode.parentNode.removeChild($('splitBody' + i).parentNode);
            }
        }
    }
    this.rows = [];
    this.rows[0] = $('splitBody0');
    $('which_doc').options.selectedIndex = 0;
    $('which_grid').options.selectedIndex = 0;
    $('splitBody0').options.selectedIndex = 0;

    $('hd').innerHTML = '<h1>' + this.headerDefault + '</h1>';
    $('ft').innerHTML = this.footerDefault;
    this.headerStr = this.headerDefault;
    this.footerStr = this.footerDefault;
    this.changeDoc();
    this.changeType();
    this.splitBody();
    $E.stopEvent(ev);
}
YAHOO.CSSGridBuilder.addRow = function(ev) {
    var tmp = $('splitBody0').cloneNode(true);
    tmp.id = 'splitBody' + this.rows.length;
    this.rows[this.rows.length] = tmp;
    this.rowCounter++;
    var p = $T.create('p', 'Row:', [$T.create('a', { href: '#', id: 'gridRowDel' + this.rows.length, title: 'Remove this row', style: 'color: red;' }, '[X]'), $T.create('br'),tmp]);
    $('splitBody0').parentNode.parentNode.appendChild(p);
    $E.addListener(tmp, 'change', YAHOO.CSSGridBuilder.splitBody, YAHOO.CSSGridBuilder, true);
    $E.addListener('gridRowDel' + this.rows.length, 'click', YAHOO.CSSGridBuilder.delRow, YAHOO.CSSGridBuilder, true);
    this.splitBody();
    $E.stopEvent(ev);
}
YAHOO.CSSGridBuilder.delRow = function(ev) {
    var tar = $E.getTarget(ev);
    var id = tar.id.replace('gridRowDel', '');
    $('splitBody0').parentNode.parentNode.removeChild(tar.parentNode);
    this.rows[id] = false;
    this.splitBody();
    $E.stopEvent(ev);
}
YAHOO.CSSGridBuilder.changeCustomDoc = function(ev) {
    var tar = $E.getTarget(ev);
        docType = $('which_doc').options[$('which_doc').selectedIndex].value;
        //console.log('Change Custom Doc: ' + tar + ' (' + $E.getEvent(ev) + '): (' + docType + ')');
        $E.stopEvent(ev);
}
YAHOO.CSSGridBuilder.changeDoc = function(ev) {
    //console.log('Change Doc: (' + $E.getEvent(ev) + ')');
    this.docType = $('which_doc').options[$('which_doc').selectedIndex].value;
    if (this.docType == 'custom-doc') {
        //$E.addListener('customDoc', 'click', YAHOO.CSSGridBuilder.changeCustomDoc, YAHOO.CSSGridBuilder, true);
        this.showSlider();
    } else {
        //$E.removeListener('customDoc', 'click', YAHOO.CSSGridBuilder.changeCustomDoc);
        this.doc.style.width = '';
        this.doc.style.minWidth = '';
        this.sliderData = false;
        this.doc.id = this.docType;
        this.doTemplate();
    }
    if (ev) {
        $E.stopEvent(ev);
        //console.log('Event Stopped');
    }
}
YAHOO.CSSGridBuilder.changeType = function() {
    this.type = this.template.options[this.template.selectedIndex].value;
    this.doc.className = this.type;
    this.doTemplate();
}
YAHOO.CSSGridBuilder.doTemplate = function() {
    if (this.storeCode) {
        this.splitBody();
    }
    var html = '';
    var str = '<p>' + $T.stringRepeat(txt, 3) + '</p>';
    var navStr = '<p>Navigation Pane</p>';
    if (this.storeCode) {
        str = '<!-- YOUR DATA GOES HERE -->';
        navStr = '<!-- YOUR NAVIGATION GOES HERE -->';
    }
    if (this.bodySplit) {
        if (this.storeCode) {
            str = $T.printf(this.bodySplit, "\t" + '<!-- YOUR DATA GOES HERE -->' + "\n\t");
        } else {
            str = $T.printf(this.bodySplit, '<p>' + txt + '</p>');
        }
    }
    switch (this.type) {
        case 'yui-t7':
            html = str;
            break;
        default:
            html = '<div id="yui-main">' + "\n\t" + '<div class="yui-b">' + str + '</div>' + "\n\t" + '</div>' + "\n\t" + '<div class="yui-b">' + navStr + '</div>' + "\n\t";
            break;
    }
    if (this.storeCode) {
        return html;
    } else {
        this.bd.innerHTML = html;
    }
}
YAHOO.CSSGridBuilder.getCode = function() {
    this.storeCode = true;
    var css = false;
    if (this.sliderData) {
        if (this.sliderData.indexOf('px') != -1) {
            var css = '#custom-doc { ' + $T.PixelToEmStyle(parseInt(this.sliderData)) + ' margin:auto; text-align:left; }';
        } else {
            var css = '#custom-doc { width: ' + this.sliderData + '; min-width: 250px; }';
        }
    }
    code = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"' + "\n" + ' "http://www.w3.org/TR/html4/strict.dtd">' + "\n";
    code += '<html>' + "\n";
    code += '<head>' + "\n";
    code += '   <title>YUI Base Page</title>' + "\n";
    code += '   <!-- The Grids Builder is designed to work with -->' + "\n";
    code += '   <!-- the Yahoo User Interface (YUI) CSS Grids tools. -->' + "\n";
    code += '   <!-- They are freely available and you can download a copy from -->' + "\n";
    code += '   <!-- their developer site here: http://developer.yahoo.com/yui/grids -->' + "\n";
    code += '   <!-- THESE PATHS NEED TO BE CHANGED -->' + "\n";
    code += '   <link rel="stylesheet" href="reset-min.css" type="text/css">' + "\n";
    code += '   <link rel="stylesheet" href="fonts-min.css" type="text/css">' + "\n";
    code += '   <link rel="stylesheet" href="grids-min.css" type="text/css">' + "\n";
    if (css) {
        code += '   <style type="text/css">' + "\n";
        code += '   ' + css + "\n";
        code += '   </style>' + "\n";
    }
    code += '</head>' + "\n";
    code += '<body>' + "\n";
    code += '<div id="' + this.docType + '" class="' + this.type + '">' + "\n";
    code += '   <div id="hd"><h1>' + this.headerStr + '</h1></div>' + "\n";
    code += '   <div id="bd">' + "\n\t" + this.doTemplate(true) + "\n\t" + '</div>' + "\n";
    //code += '   <div id="bd">' + "\n\t" + this.getTemplateCode() + "\n\t" + '</div>' + "\n";
    code += '   <div id="ft">' + this.footerStr + '</div>' + "\n";
    code += '</div>' + "\n";
    code += '</body>' + "\n";
    code += '</html>' + "\n";

    this.storeCode = false;

    return code;
}
YAHOO.CSSGridBuilder.getTemplateCode = function() {
    var html = $('gridbuilder1').cloneNode(true);
    var p = html.getElementsByTagName('p');
    for (var i = 0; i < p.length; i++) {
        p[i].parentNode.removeChild(p[i]);
    }
    return html.innerHTML;
}
YAHOO.CSSGridBuilder.showCode = function(ev) {
    code = this.getCode();
    showCode = new YAHOO.widget.Dialog('showCode', {
            close: true,
            modal: true,
            visible: true,
            fixedcenter: true,
            height: '450px',
            width: '650px',
            zindex: 9001
        }
    );
    showCode.setHeader('CSSGridBuilder Code');
    showCode.setBody('<textarea style="height: 300px; width: 99%;" name="code" class="HTML">' + code + '</textarea>');
    showCode.render(document.body);
    dp.SyntaxHighlighter.HighlightAll('code');
    $E.stopEvent(ev);
}
YAHOO.CSSGridBuilder.setHeader = function(ev) {
    var str = prompt('Set header value to: ', this.headerStr);
    if (str != null) {
        this.headerStr = str;
        $('hd').innerHTML = '<h1>' + str + '</h1>';
    }
    $E.stopEvent(ev);
}
YAHOO.CSSGridBuilder.setFooter = function(ev) {
    var str = prompt('Set footer value to: ', this.footerStr);
    if (str != null) {
        this.footerStr = str;
        $('ft').innerHTML = str;
    }
    $E.stopEvent(ev);
}
YAHOO.CSSGridBuilder.splitBody = function() {
    this.bodySplit = '';
    for (var i = 0; i < this.rows.length; i++) {
        //this.splitBodyTemplate($('splitBody' + i), i);
        var str = this.splitBodyTemplate($('splitBody' + i).options[$('splitBody' + i).selectedIndex].value);
        if (!this.storeCode) {
            this.bodySplit += '<div id="gridBuilder' + i + '">' + str + '</div>';
        } else {
            this.bodySplit += str;
        }
    }
    if (!this.storeCode) {
        this.doTemplate();
    }
}
YAHOO.CSSGridBuilder.splitBodyTemplate = function(bSplit) {
    var str = '';
    bSplit = parseInt(bSplit);
    switch (bSplit) {
        case 1:
            str += '<div class="yui-g">' + "\n";
            str += '{0}';
            str += '</div>' + "\n";
            break;
        case 2:
            str += '<div class="yui-g">' + "\n";
            str += '    <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '    <div class="yui-u">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
        case 3:
            str += '<div class="yui-g">' + "\n";
            str += '    <div class="yui-gb first">' + "\n";
            str += '        <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '        <div class="yui-u">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '        <div class="yui-u">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
        case 4:
            str += '<div class="yui-g">' + "\n";
            str += '    <div class="yui-g first">' + "\n";
            str += '        <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '        <div class="yui-u">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '    </div>' + "\n";
            str += '    <div class="yui-g">' + "\n";
            str += '        <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '        <div class="yui-u">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
        case 5:
            str += '<div class="yui-g">' + "\n";
            str += '    <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '    <div class="yui-g">' + "\n";
            str += '        <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '        <div class="yui-u">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
        case 6:
            str += '<div class="yui-g">' + "\n";
            str += '    <div class="yui-g first">' + "\n";
            str += '        <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '        <div class="yui-u">' + "\n";
            str += '{0}';
            str += '        </div>' + "\n";
            str += '    </div>' + "\n";
            str += '    <div class="yui-u">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
        case 7:
            str += '<div class="yui-gc">' + "\n";
            str += '    <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '    <div class="yui-u">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
        case 8:
            str += '<div class="yui-gd">' + "\n";
            str += '    <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '    <div class="yui-u">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
        case 9:
            str += '<div class="yui-ge">' + "\n";
            str += '    <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '    <div class="yui-u">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
        case 10:
            str += '<div class="yui-gf">' + "\n";
            str += '    <div class="yui-u first">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '    <div class="yui-u">' + "\n";
            str += '{0}';
            str += '    </div>' + "\n";
            str += '</div>' + "\n";
            break;
    }

    return str;
}
YAHOO.CSSGridBuilder.mouseOver = function(ev) {
    var elm = $E.getTarget(ev);
    var path = [];
    var new_path = [];
    cont = true;
    while (cont) {
        if (elm.className) {
            path[path.length] = elm.className;
        }
        if (elm.parentNode) {
            elm = elm.parentNode;
        } else {
            cont = false;
        }
    }
    for (var i = (path.length - 1); i >= 0; i-- ) {
        new_path[new_path.length] = path[i];
    }
    this.bd.title = '#' + this.docType + ': ' + new_path.join(' :  ');
}
YAHOO.CSSGridBuilder.showSlider = function() {
    showSlider = new YAHOO.widget.Dialog('showSlider', {
            close: true,
            dragable: false,
            modal: true,
            visible: true,
            fixedcenter: true,
            width: '275px',
            zindex: 9001,
            postmethod: 'none'
        }
    );
    showSlider.setHeader('CSSGridBuilder Custom Body Size');
    var body = '<p>Adjust the slider below to adjust your body size or set it manually with the text input. <i>(Be sure to include the % or px in the text input)</i></p>';
    body += '<form name="customBodyForm" method="POST" action="">';
    body += '<p>Current Setting: <input type="text" id="sliderValue" value="100%" size="8" onfocus="this.select()" /></p>';
    body += '<span>Unit: ';
    body += '<input type="radio" name="movetype" id="moveTypePercent" value="percent" checked> <label for="moveTypePercent">Percent</label>&nbsp;';
    body += '<input type="radio" name="movetype" id="moveTypePixel" value="pixel"> <label for="moveTypePixel">Pixel</label></span>';
    body += '</form>';
    body += '<div id="sliderbg"><div id="sliderthumb"><img src="http://developer.yahoo.com/yui/examples/slider/img/horizSlider.png" /></div>';
    body += '</div>';
    showSlider.setBody(body);

    var handleCancel = function() {
        showSlider.hide();
        return false;
    }
    var handleSubmit = function() {
        YAHOO.CSSGridBuilder.sliderData = $('sliderValue').value;

        showSlider.hide();
    }

    var myButtons = [
        { text:'Save', handler: handleSubmit, isDefault: true },
        { text:'Cancel', handler: handleCancel }
    ];
    
    var handleChange = function(f) {
        if (typeof f == 'object') { f = slider.getValue(); }
        if ($('moveTypePercent').checked) {
            var w = Math.round(f / 2);
            $('custom-doc').style.width = w + '%';
            $('sliderValue').value = w + '%';
        } else {
            var w = Math.round(f / 2);
            var pix = Math.round($D.getViewportWidth() * (w / 100));
            $('custom-doc').style.width = pix + 'px';
            $('sliderValue').value = pix + 'px';
        }
        $('custom-doc').style.minWidth = '250px';
    }

    var handleBlur = function() {
        f = $('sliderValue').value;
        if (f.indexOf('%') != -1) {
            $('moveTypePercent').checked = true;
            f = (parseInt(f) * 2);
        } else if (f.indexOf('px') != -1) {
            $('moveTypePixel').checked = true;
            f = (((parseInt(f) / $D.getViewportWidth()) * 100) * 2);
        } else {
            $('sliderValue').value = '100%';
            f = 200;
        }
        slider.setValue(f);
    }

    showSlider.cfg.queueProperty("buttons", myButtons);

    showSlider.render(document.body);
    slider = YAHOO.widget.Slider.getHorizSlider('sliderbg', 'sliderthumb', 0, 200, 1);
    slider.setValue(200);
    slider.onChange = handleChange;
    
    $E.addListener(['moveTypePercent', 'moveTypePixel'], 'click', handleChange);
    $E.addListener('sliderValue', 'blur', handleBlur);

    this.doc.id = this.docType;
    this.doc.style.width = '100%';
    this.doTemplate();


}

