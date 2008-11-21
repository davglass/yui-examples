(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var count = function() {
        var editor = Dom.get('editor'),
            text = editor.value,
            wordCount = 0,
            charCount = ((text.length) ? text.length : ((editor.textLength) ? editor.textLength : 0));

        if (charCount > 0) {
            wordCount = text.match(/\b/g);
            wordCount = ((wordCount) ? (wordCount.length / 2) : 0);
        }

        var start = editor.selectionStart,
            end = editor.selectionEnd,
            rows = 0, cols = 0;

        if (YAHOO.env.ua.ie) {
            if (document.selection) {
                var range = document.selection.createRange();
                var stored_range = range.duplicate();
                stored_range.moveToElementText(editor);
                stored_range.setEndPoint('EndToEnd', range);
                start = stored_range.text.length - range.text.length;
                end = start + range.text.length;
            }
            
        }
        
        var rowList = text.split(/\n/),
            r = 0;
            rowCount = ((rowList) ? rowList.length : 1);

        for (var i = 0; i < rowCount; i++) {
            if (YAHOO.env.ua.gecko) {
                charCount++;
            }
            r += (rowList[i].length + 1);
            var sc = (r - rowList[i].length - 1),
                ec = ((rowList[i].length + 1) + sc);
            if ((start >= sc) && (start <= ec)) {
                rows = (i + 1);
                cols = ((start - sc) + 1);
            }
        }

        if (YAHOO.env.ua.gecko) {
            charCount--;
        }
        if (start !== end) { //No Selection
            rows = 0, cols = 0;
        }

        Dom.get('words').innerHTML = 'Words: ' + wordCount;
        Dom.get('chars').innerHTML = 'Chars: ' + charCount;
        Dom.get('rows').innerHTML = 'Rows: ' + rows;
        Dom.get('cols').innerHTML = 'Cols: ' + cols;
    };

    Event.onDOMReady(function() {
        count();
        Event.on('editor', 'keyup', count);
        Event.on('editor', 'keypress', count);
        Event.on('editor', 'mouseup', count);
        Dom.get('editor').focus();
    });
})();

