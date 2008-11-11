"Starting YUI methods
" Vim syntax file
" Language:	JavaScript
" Maintainer:	Claudio Fleiner <claudio@fleiner.com>
" Updaters:	Scott Shattuck (ss) <ss@technicalpursuit.com>
" URL:		http://www.fleiner.com/vim/syntax/javascript.vim
" Changes:	(ss) added keywords, reserved words, and other identifiers
"		(ss) repaired several quoting and grouping glitches
"		(ss) fixed regex parsing issue with multiple qualifiers [gi]
"		(ss) additional factoring of keywords, globals, and members
" Last Change:	2005 Nov 12 (ss)

" For version 5.x: Clear all syntax items
" For version 6.x: Quit when a syntax file was already loaded
" tuning parameters:
" unlet javaScript_fold

if !exists("main_syntax")
  if version < 600
    syntax clear
  elseif exists("b:current_syntax")
    finish
  endif
  let main_syntax = 'javascript'
endif

" Drop fold if it set but vim doesn't support it.
if version < 600 && exists("javaScript_fold")
  unlet javaScript_fold
endif

syntax case match



syntax region javaScriptDocComment    matchgroup=javaScriptComment start="/\*\*\s*$"  end="\*/" contains=javaScriptDocTags,javaScriptDocSeeTag,javaScriptCommentTodo,javaScriptCvsTag,@javaScriptHtml,@Spell fold
syntax match  javaScriptDocTags       contained "@\(param\|argument\|requires\|exception\|throws\|type\|class\|extends\|see\|link\|member\|base\|file\)\>" nextgroup=javaScriptDocParam skipwhite
syntax match  javaScriptDocTags       contained "@\(deprecated\|fileoverview\|author\|license\|version\|returns\=\|constructor\|private\|final\|ignore\|addon\|exec\)\>"
syntax match  javaScriptDocParam      contained "\%(#\|\w\|\.\|:\|\/\)\+"
syntax region javaScriptDocSeeTag     contained matchgroup=javaScriptDocSeeTag start="{" end="}" contains=javaScriptDocTags

syn keyword javaScriptCommentTodo      TODO FIXME XXX TBD contained
syn match   javaScriptLineComment      "\/\/.*" contains=javaScriptCommentTodo
syn match   javaScriptCommentSkip      "^[ \t]*\*\($\|[ \t]\+\)"
syn region  javaScriptComment	       start="/\*"  end="\*/" contains=javaScriptCommentTodo
syn match   javaScriptSpecial	       "\\\d\d\d\|\\."
syn region  javaScriptStringD	       start=+"+  skip=+\\\\\|\\"+  end=+"\|$+  contains=javaScriptSpecial,@htmlPreproc
syn region  javaScriptStringS	       start=+'+  skip=+\\\\\|\\'+  end=+'\|$+  contains=javaScriptSpecial,@htmlPreproc

syn match   javaScriptSpecialCharacter "'\\.'"
"syn match   javaScriptNumber	       "-\=\<\d\+L\=\>\|0[xX][0-9a-fA-F]\+\>"
syn region  javaScriptRegexpString     start=+/[^/*]+me=e-1 skip=+\\\\\|\\/+ end=+/[gi]\{0,2\}\s*$+ end=+/[gi]\{0,2\}\s*[;.,)]+me=e-1 contains=@htmlPreproc oneline

syn keyword javaScriptConditional	if else switch
syn keyword javaScriptRepeat		while for do in
syn keyword javaScriptBranch		break continue
syn keyword javaScriptOperator		new delete instanceof typeof
syn keyword javaScriptType		Array Boolean Date Function Number Object String RegExp Math prototype
syn keyword javaScriptStatement		return with
syn keyword javaScriptBoolean		true false
syn keyword javaScriptNull		null
syn keyword javaScriptError		undefined
syn keyword javaScriptIdentifier	arguments this var options document location style
syn keyword javaScriptLabel		case default
syn keyword javaScriptException		try catch finally throw
syn keyword javaScriptMessage		alert confirm prompt status
syn keyword javaScriptGlobal		self window top parent left right bottom
syn keyword javaScriptMember		toLowerCase toUpperCase execCommand event queryCommandValue getElementById getElementsByTagName parentNode readyState onreadystatechange createElement XMLHttpRequest substring open setAttribute getAttribute appendChild send alert confirm prompt documentElement responseXML responseText firstChild removeChild replaceChild nodeValue length floor random nextSibling tagName childNodes clearTimeout setTimeout navigator indexOf userAgent offsetWidth offsetHeight toUpperCase split charAt replace push map join escape encodeURI encodeURIComponent match className body innerHTML innerText cellPadding cellSpacing colSpan rowSpan onclick href onload id scroll scrollLeft scrollTop scrollSensitivity scrollBy appVersion insertBefore clearInterval setInterval toString console call apply value parseInt writeOnce method readOnly scrollIntoView push pop splice slice shift unshift

syn keyword javaScriptYUI    YAHOO util widget example Panel configClose render stackMask hideMask initEvents configModal configKeyListeners init toString buildWrapper destroy removeMask configHeight showMask registerDragDrop configUnderlay buildMask configWidth configDraggable sizeMask configzIndex sizeUnderlay initDefaultConfig KeyListener enable disable Toolbar getButtons enableButton destroyButton addButton initAttributes selectButton enableAllButtons addButtonToGroup collapse addSeparator getButtonByIndex getButtonById resetAllButtons deselectAllButtons disableButton deselectButton addButtonGroup disableAllButtons getButtonByValue PieChart Resize getProxyEl getResizeById getStatusEl getWrapEl resize reset getActiveHandleEl isActive Config fireQueue alreadySubscribed getProperty addProperty 
syn keyword javaScriptYUI    queueProperty checkNumber outputEventQueue resetProperty applyConfig refresh subscribeToConfigEvent checkBoolean refireEvent getConfig setProperty unsubscribeFromConfigEvent Node setDynamicLoad getChildrenEl toggle 0 getToggleEl getHtml insertBefore hasChildren isDynamic getEl appendTo showChildren insertAfter getChildrenElId getDepthStyle expandAll getToggleLink getSiblings getStyle getNodeHtml getIconMode hideChildren getAncestor loadComplete expand getElId isRoot completeRender getToggleElId getHoverStyle collapseAll applyParent ColumnSeries ColumnChart Region getArea getRegion union intersect ContainerEffect handleTweenAnimateOut handleStartAnimateIn handleStartAnimateOut animateOut handleCompleteAnimateOut handleTweenAnimateIn SLIDE FADE handleCompleteAnimateIn 
syn keyword javaScriptYUI    animateIn Motion LineSeries BarChart TimeAxis CustomEvent fire unsubscribeAll subscribe unsubscribe MenuBarItem Module configMonitorResize appendToHeader setBody hide onDomResize setFooter initResizeMonitor appendToBody appendToFooter configVisible setHeader show FirstPageLink onClick update Wait XML JSON lang isArray trim isString isBoolean extend merge augmentObject later substitute isNull isValue hasOwnProperty augment augmentProto isFunction isNumber isObject dump isUndefined DataTable sortColumn getColumnById editCheckbox setColumnWidth focus onEventSelectColumn formatTextarea onEventSelectCell getId getTrIndex isSelected onEventSaveCellEditor deleteRow showTableMessage onDataReturnAppendRows unhighlightCell getCell editTextarea clearTextSelection getBelowTdEl 
syn keyword javaScriptYUI    getFirstTdEl formatRadio selectColumn removeColumn onEventHighlightRow showCellEditor showColumn getSelectedRows getTdEl onEventEditCell onDataReturnReplaceRows addRows onEventHighlightCell onEventSelectRow onEventUnhighlightColumn formatCheckbox onEventShowCellEditor updatePaginator deleteRows handleDataSourcePagination highlightColumn onPaginatorChange getThLinerEl getRecordSet updateRow unhighlightColumn hideTableMessage onEventUnhighlightCell formatPaginatorDropdown editDate formatCurrency unselectRow formatTheadCell getTbodyEl formatLink getTdLinerEl getColumnSet addRow editRadio formatPaginators getPreviousTrEl getMsgTdEl getRow formatEmail unselectCell getCellEditor getAboveTdEl onEventFormatCell getBody onEventUnhighlightRow getPreviousTdEl unselectAllRows 
syn keyword javaScriptYUI    getSelectedTdEls onDataReturnInitializeTable doBeforeShowCellEditor unSelectColumn getMsgTbodyEl getColumn formatNumber getDataSource getColumnSortDir formatPaginatorLinks select getNextTrEl editDropdown getNextTdEl onDataReturnInsertRows saveCellEditor unhighlightRow getSelectedCells formatTextbox getLastSelectedCell onEventCancelCellEditor selectRow getLastTrEl onEventHighlightColumn formatText showCellEditorBtns getLastSelectedRecord getTheadEl editTextbox insertColumn getSelectedTrEls getThEl getFirstTrEl hideColumn onDataReturnSetRecords refreshView focusTheadEl getRecord handleSimplePagination focusTbodyEl initializeTable highlightCell formatButton formatDropdown selectCell cancelCellEditor resetCellEditor onEventSortColumn getRecordIndex doBeforeLoadData 
syn keyword javaScriptYUI    getContainerEl validateNumber getLastTdEl getSelectedColumns formatDate getTrEl formatCell showPage highlightRow unselectAllCells AttributeProvider set fireBeforeChangeEvent resetValue get setAttributeConfig register configureAttribute getAttributeKeys fireChangeEvent setAttributes ColorAnim parseColor stringify isValid dateToString parse stringToDate srcImgObj CartesianChart Layout addUnit removeUnit getUnitByPosition getLayoutById getUnitById getSizes DDProxy createFrame initFrame RecordSet hasRecords updateRecord replaceRecords addRecord updateKey deleteRecord getLength reverseRecords addRecords setRecords getRecords sortRecords updateRecordValue setRecord deleteRecords TextNode getLabelEl onLabelClick imgObj fetch ImageCropper getCropCoords getResizeObject getResizeMaskEl 
syn keyword javaScriptYUI    getCropperById getResizeEl getMaskEl ContextMenuItem EventProvider hasEvent fireEvent createEvent DataSource flushCache getResults doQuery Profiler getFunctionReport getFullReport unregisterFunction getCallCount registerFunction getAverage getMin unregisterObject getMax registerConstructor registerObject OverlayManager showAll hideAll blurAll remove bringToTop getActive find SimpleEditor cmd_inserthtml filter_invalid_lists closeWindow nodeChange cmd_fontname cmd_forecolor filter_all_rgb filter_rgb cmd_createlink cmd_insertorderedlist cmd_insertunorderedlist cmd_insertimage getEditorHTML saveHTML cleanHTML setEditorHTML _cleanIncomingHTML openWindow pre_filter_linebreaks clearEditorDoc cmd_backcolor moveWindow filter_safari filter_internals cmd_list cmd_fontsize 
syn keyword javaScriptYUI    post_filter_linebreaks cmd_unlink execCommand _setEditorStyle Get script abort css DS_XHR parseResponse TVFadeIn onComplete animate CalendarGroup deselectCell addWeekdayRenderer nextYear delegateConfig configPages subtractYears previousMonth callChildFunction deselect previousYear nextMonth configPageDate setChildFunction addMonthRenderer removeRenderers renderFooter configSelected getSelectedDates addRenderer deselectAll setMonth clear getCalendarPage addMonths subtractMonths constructChild setYear renderHeader addYears CategoryAxis Assert isNaN isTrue areNotSame isNotNaN isNotUndefined areNotEqual isFalse isTypeOf isNotNull areSame fail areEqual isInstanceOf LogMsg ElementWrapper CurrentPageReport sprintf Bezier getPosition Subscriber getScope PageLinks rebuild 
syn keyword javaScriptYUI    calculateRange MenuBar env getVersion ShouldFail SliderThumb getValue getOffsetFromParent getYValue initSlider getXValue clearTicks PreviousPageLink Column getTreeIndex getParent getColspan getDefinition getKey getKeyIndex getRowspan getColEl getResizerEl ua LogWriter getSource log setSource PieSeries YAHOO_config Dialog configButtons focusFirstButton doSubmit focusFirst focusLastButton getData submit focusLast cancel focusDefaultButton validate configPostMethod registerForm blurButtons TestSuite tearDown add setUp ColumnResizer onDrag resetResizerEl onMouseUp onMouseDown DualSlider setMinValue setMaxValue setValues Editor cmd_superscript cmd_script cmd_hiddenelements cmd_indent cmd_heading cmd_subscript cmd_outdent cmd_removeformat Element appendChild addListener 
syn keyword javaScriptYUI    removeClass on getElementsByTagName getElementsByClassName setStyle removeChild hasChildNodes replaceClass replaceChild hasClass removeListener addClass DragDrop addToGroup startDrag isValidHandleChild lock onDragEnter setOuterHandleElId unlock resetConstraints clickValidator onDragOver addInvalidHandleType setDragElId setXConstraint clearConstraints removeInvalidHandleType setHandleElId onDragOut onInvalidDrop removeFromGroup initTarget removeInvalidHandleClass onDragDrop removeInvalidHandleId onAvailable getDragEl setYConstraint endDrag isLocked addInvalidHandleClass setPadding unreg addInvalidHandleId ColumnSet getDefinitions getDescendants TreeView animateExpand getNodeByIndex addHandler collapseComplete onExpand removeHandler preload setExpandAnim getTree removeNode 
syn keyword javaScriptYUI    popNode onCollapse removeChildren animateCollapse draw getNode getNodeByProperty getNodesByProperty getRoot getNodeByElement setUpLabel setCollapseAnim expandComplete namespace Anim isAnimated setEl getAttribute setAttribute doMethod stop getDefaultUnit getStartTime Sort compare UserAction mouseEvent keypress keyup mouseup keydown mousemove mousedown mouseout mouseover click dblclick Tab Menu configMaxHeight configDisabled getSubmenus positionOffScreen getItemGroups setInitialSelection addItems setInitialFocus clearActiveItem hasFocus blur configHideDelay onRender getItems insertItem addItem configContainer clearContent enforceConstraints getItem removeItem setItemGroupTitle configIframe configClassName configPosition Number format Calendar2up Slider getHorizDualSlider 
syn keyword javaScriptYUI    getHorizSlider handleKeyDown setRegionValue onSliderEnd getSliderRegion verifyOffset initThumb onChange setValue setThumbCenterPoint onSlideStart getThumb getVertSlider handleKeyPress setStartSliderState getVertDualSlider bgImgObj LayoutUnit getLayoutUnitById close DS_JSFunction NumericAxis Uploader uploadAll browse clearFileList upload removeFile ShouldError ComparisonFailure ContextMenu configTrigger Easing easeIn easeInStrong bounceBoth backOut elasticBoth elasticOut bounceOut backBoth easeBoth bounceIn easeOutStrong easeNone elasticIn easeBothStrong easeOut backIn DragDropMgr getDDById getScrollTop stopEvent getClientWidth stopDrag getPosX regDragDrop getElement getCss isTypeOfDD getClientHeight getBestMatch numericSort isDragDrop getLocation regHandle getRelated 
syn keyword javaScriptYUI    handleWasClicked swapNode getScrollLeft getPosY isLegalTarget refreshCache isHandle verifyEl moveToEl Chain pause run MenuItem configURL configEmphasis configTarget configStrongEmphasis configSubmenu configOnClick getPreviousEnabledSibling configHelpText getNextEnabledSibling configChecked configText CartesianSeries Scroll DateMath isYearOverlapWeek getWeekNumber getDayOffset findMonthEnd after clearTime isMonthOverlapWeek getJan1 between findMonthStart getDate subtract before Color hsv2rgb websafe rgb2hsv hex2dec rgb2hex real2dec dec2hex hex2rgb SimpleDialog configIcon Connect asyncRequest isCallInProgress initHeader setDefaultXhrHeader setForm resetDefaultHeaders setDefaultPostHeader setProgId setPollingInterval LineChart FlashAdapter Date TVAnim getAnim YUILoader 
syn keyword javaScriptYUI    parseSkin calculate onFailure insert onProgress require getRequires addModule onSuccess loadNext getProvides formatSkin ColorPicker initPicker ToolbarButton getMenu checkValue Attribute configure resetConfig DateAssert group registerBgImage addCustomTrigger addTrigger registerSrcImage registerPngBgImage RowsPerPageDropdown DS_JSArray Calendar configLocale buildWeekdays renderOutOfBoundsDate resetRenderers renderBody createTitleBar applyListeners clearAllBodyCellStyles onBeforeSelect removeCloseButton renderCellStyleHighlight2 renderCellStyleHighlight3 renderCellStyleHighlight1 renderCellStyleHighlight4 configOptions renderCellNotThisMonth configLocaleValues buildMonthLabel getDateFieldsByCellId configMaxDate styleCellDefault doCellMouseOver doCellMouseOut onClear 
syn keyword javaScriptYUI    onDeselect configNavigator initStyles onReset isDateOOM getCellIndex isDateOOB doSelectCell renderRowHeader renderRowFooter renderBodyCellRestricted onBeforeDeselect onChangePage renderCellStyleSelected clearElement renderCellDefault buildDayLabel toDate createCloseButton configTitle removeTitleBar configMinDate getDateByCellId onSelect renderCellStyleToday Axis Cookie setSub setSubs getHash getSub EditorInfo getEditorById TestReporter report addField ArrayAssert containsMatch doesNotContain indexOf itemsAreSame containsItems doesNotContainItems itemsAreEquivalent itemsAreEqual isEmpty lastIndexOf isNotEmpty doesNotContainMatch UnexpectedError parseString clearInterval parseArrayData sendRequest issueCallback parseJSONData parseTextData parseHTMLTableData doBeforeCallback 
syn keyword javaScriptYUI    parseDate addToCache getCachedResponse setInterval handleResponse parseXMLData isCacheHit makeConnection doBeforeParseData parseNumber clearAllIntervals TestRunner Series DDTarget ButtonGroup getButton addButtons removeButton getCount check LogReader getLastTime setTitle getCategories showSource getCheckbox showCategory resume getSources hideCategory formatMsg clearConsole hideSource pngBgImgObj MenuManager getFocusedMenu addMenu getVisible getFocusedMenuItem getMenuItemGroup getMenuItem getMenus hideVisible removeMenu Logger getStack handleWindowErrors enableBrowserConsole disableBrowserConsole unhandleWindowErrors Overlay moveTo stackIframe showIframe configFixedCenter windowResizeHandler showMacGeckoScrollbars hideMacGeckoScrollbars configXY syncPosition hideIframe 
syn keyword javaScriptYUI    getConstrainedXY configContext configConstrainToViewport windowScrollHandler center align syncIframe configY configX doCenterOnDOMEvent EditorWindow Paginator getRowsPerPage getTotalRecords getPreviousPage getTotalPages updateVisibility hasNextPage setStartIndex getCurrentPage getState hasPreviousPage getStartIndex setTotalRecords hasPage setRowsPerPage setPage getNextPage getContainerNodes getPageRecords AnimMgr start registerElement Event getTime generateId getTarget stopPropagation getCharCode resolveTextNode getXY onContentReady onDOMReady getListeners getEvent purgeElement preventDefault getPageY getPageX getRelatedTarget Dom getElementsBy getDocumentWidth getX getY getChildren getFirstChild getClientRegion getLastChildBy getAncestorBy getPreviousSiblingBy 
syn keyword javaScriptYUI    getNextSibling getDocumentHeight getLastChild inDocument getViewportHeight getAncestorByClassName getViewportWidth setXY getPreviousSibling getDocumentScrollTop setX setY getFirstChildBy getNextSiblingBy batch getChildrenBy isAncestor getDocumentScrollLeft getAncestorByTagName TVFadeOut HTMLNode getContentEl LastPageLink Chart setStyles setSeriesStyles ColumnDD RootNode TestNode ProfilerViewer getDataTable refreshData getHeadEl getChartEl getBodyEl getTableEl getChart DD setDragElPos alignElWithMouse autoOffset setDelta cachePosition DS_ScriptNode NextPageLink Calendar_Core Button createButtonElement getForm removeStateCSSClasses onFormKeyPress addHiddenFieldsToForm getHiddenFields createHiddenFields addStateCSSClasses removeHiddenFields AutoComplete getListItems 
syn keyword javaScriptYUI    doBeforeExpandContainer doBeforeSendQuery getListItemData sendQuery isContainerOpen formatResult TestCase wait ObjectAssert hasProperty propertiesAreEqual UnexpectedValue getMessage ToolbarButtonAdvanced AssertionError valueOf MenuNode Record setData TabView getTabIndex removeTab contentTransition DOMEventHandler addTab getTab CalendarNavigator createNav erase applyKeyListeners setError renderNavContents setYearError getYear getMonth renderButton clearErrors purgeListeners clearYearError clearError createMask purgeKeyListeners renderYear Selector test filter tokenize query History getCurrentState onReady navigate getBookmarkedState initialize getQueryStringParameter multiNavigate BarSeries TestLogger clearTestRunner setTestRunner TestManager load setPages Point 
syn keyword javaScriptYUI    Tooltip onContextMouseOver doShow doHide onContextMouseOut onContextMouseMove preventOverlay 
syn keyword javaScriptYUIPrivate    handleKeyPress _buttonClick _resetColorPicker _addMenuClasses _makeSpinButton _createColorPicker _makeColorButton _setDataField _setCategoryField _getCategoryField _initAttributes _getDataField _handle_for_bl _setHeight _handleStartDrag _handle_for_tl _snapTick initAttributes _handle_for_tr _handle_for_br _createProxy _setCache init _createHandles _setAutoRatio _ieSelectFix _checkWidth _handleMouseDown _createWrap _setupDragDrop _handleMouseOver _handleMouseUp _setRatio _setWidth _checkHeight _handle_for_r _handle_for_t _updateStatus _handle_for_l _handleMouseOut _handle_for_b fireEvent appendChild isChildOf getChildrenHtml renderChildren _delete _supportsCWResize _initResizeMonitor _addToParent destroy _unselectAllTdEls _initNodeTemplates _handleSingleCellSelectionByMouse 
syn keyword javaScriptYUIPrivate    _onTheadClick _handleSingleCellSelectionByKey _onTbodyClick _initColumnDragTargetEl _handleCellRangeSelectionByKey _onTheadKeydown _cloneObject _handleStandardSelectionByMouse _handleDataReturnPayload _onTbodyKeydown _addTdEl _initCellEditorEl _setColumnWidth _initContainerEl _onPaginatorLinkClick _onTableMousedown _initDataSource _initColumnSort _initColumnSet _onTableMouseout _setRowStripes _deleteTrEl _setFirstRow _handleSingleSelectionByMouse _onDocumentClick _onTableFocus _handleCellBlockSelectionByMouse _onTheadFocus _generateRequest _handleCellBlockSelectionByKey _initRecordSet _updateTrEl _initTableEl _getSelectionAnchor _setLastRow _initColumnResizerProxyEl _onTbodyFocus _getSelectionTrigger _createTrEl _onScroll _initConfigs _initThEl _initTheadEls 
syn keyword javaScriptYUIPrivate    _handleStandardSelectionByKey _handleCellRangeSelectionByMouse _focusEl _onTableKeypress _syncScrollPadding _unselectAllTrEls _onPaginatorDropdownChange _onTableDblclick _onTableMouseover _syncColWidths _handleSingleSelectionByKey resetAttributeConfig getAttributeConfig _applyFilter _applyUrl _setYAxis _getYField _setXAxis _getXField _setXField _setYField _stamp _setupElements _setBodySize _setCenter _createUnits _setupBodyElements _setSides _resizeProxy showFrame _setRecord _deleteRecord _addRecord _handleStartResizeEvent _setBackgroundImage _handleResizeEvent _handleBeforeResizeEvent _syncBackgroundPosition _moveEl _handleKeyPress _handleDragEvent _createResize _handleB4DragEvent _setConstraints _setBackgroundPosition _createMask _init _doQueryCache _addCacheElem 
syn keyword javaScriptYUIPrivate    _saveData compareZIndexDesc _onOverlayElementFocus _onOverlayDestroy _setCurrentEvent _checkLoaded _toggleDesignMode _handleAfterNodeChange _handleFormSubmit _handleFontSize _updateMenuChecked _cleanClassName _setDesignMode _render _getSelection _createIframe _getDoc _handleInsertImageWindowClose _handleToolbarClick _disableEditor _setupAfterElement _getDomPath _hasParent _listFix _createCurrentElement _handleKeyDown _closeWindow _fixNodes _isLocalFile _swapEl _getSelectedElement _handleInsertImageClick _renderPanel _hasSelection _handleColorPicker _selectNode _handleAutoHeight _handleAlign _focusWindow _isNonEditable _isElement _initEditor _handleKeyUp _handleCreateLinkClick _getBlankImage _setMarkupType _handleCreateLinkWindowClose _setInitialContent _handleDoubleClick 
syn keyword javaScriptYUIPrivate    _getWindow _writeDomPath _handleClick _getRange _purge _finalize _autoPurge _finish _linkNode _returnData queue _scriptNode _node _next _track sub _setMonthOnDate _fixWidth unsub _onClick checkPosition _onKeyDown onChange clickValidator handleMouseDown _handleSlideStart _oneTimeCallback _handleSlideEnd _handleDrag selectActiveSlider _cleanEvent updateValue _handleMinChange _handleMaxChange _registerHTMLAttr b4Drag b4StartDrag setStartPosition getTick getTargetCoord setInitialPosition b4DragDrop setYTicks b4EndDrag b4DragOver handleOnAvailable b4MouseDown b4DragOut setXTicks regNode _removeChildren_animComplete _deleteNode generateId onTween setRuntimeAttribute fireKeyEvent simulateMouseEvent simulateKeyEvent _onRender _onMenuItemBlur _onVisibleChange _onMenuItemDestroy 
syn keyword javaScriptYUIPrivate    _onBeforeRender _cancelShowDelay _getItemGroup _onInit _updateItemProperties _onItemAdded _onSubmenuBeforeShow _removeItemFromGroupByValue _onMenuItemConfigChange _onMouseOver _onParentMenuRender _execShowDelay _enableScrollFooter _onBeforeShow _addItemToGroup _onParentMenuConfigChange _cancelHideDelay _onBeforeHide _getFirstEnabledItem _createItemGroup _configureSubmenu _onScrollTargetMouseOut _disableScrollHeader _enableScrollHeader _removeItemFromGroupByIndex _onShow _disableScrollFooter _onMenuItemFocus _onMouseMove _setMaxHeight _subscribeToItemEvents _onYChange _onMouseOut _initSubTree _onScrollTargetMouseOver _onKeyPress _execSubmenuHideDelay _execHideDelay fireEvents focus onMouseDown moveThumb thumbMouseUp moveOneTick handleThumbChange endMove onDrag 
syn keyword javaScriptYUIPrivate    _getNextY _getNextX _getBoxSize _getBorderSizes _toggleClip _fixQuirks _createClip _cleanGrids _createHeader _onTriggerClick position _onTriggerContextMenu _removeEventHandlers removeDDFromGroup unregAll _onResize _onLoad handleMouseMove _execOnAll _remove isOverTarget _onUnload getElWrapper _addListeners handleMouseUp getScroll _createRootNodeStructure _onSubmenuBeforeHide _addDays _createHostElement createResponseObject initCustomEvents uploadFile resetFormState getConnectionObject createExceptionObject appendPostData releaseObject createXhrObject handleTransactionResponse createFrame handleReadyState setHeader _loadHandler eventHandler _eventHandler _embedSWF _getSWFURL _setup _explode _sort _pushEvents _skin _url _addSkin _reduce _rollup _hexFieldKeypress 
syn keyword javaScriptYUIPrivate    _updateRGBFromHSV _onHueSliderChange _updatePickerSlider _updateRGB _numbersOnly _updateSwatch _updateSliders _onPickerSliderChange _getCommand _updateHex _updateFormFields _hexOnly _updateHueSlider _getS _getValuesFromSliders _getV _getH _rgbFieldKeypress _handleSelect _getFetchTimeout _onloadTasks _foldCheck _fetchByClass _parseArgs _parsePageDate _indexOfSelectedFieldArray _parseDates _parseRange _addRenderer _fieldArraysAreEqual _parseDate refreshLocale _toFieldArray _toDate _parseCookieHash _createCookieHash _parseCookieString _createCookieString executeJSONParser _xhrFailure _xhrSuccess _setDisabled _onAppendTo _onButtonCheckedChange _createGroupElement _onReset _createSourceCheckbox _onClickClearBtn _initCategories _printToConsole _initHeaderEl _initDragDrop 
syn keyword javaScriptYUIPrivate    _printBuffer _onClickCollapseBtn _onCategoryCreate _onSourceCreate _onClickPauseBtn _initFooterEl _onNewLog html2Text _filterLogs _onCheckCategory _onCheckSource _initSources _createCategoryCheckbox _initConsoleEl onDOMEvent onMenuVisibleConfigChange getMenuRootElement onMenuDestroy onMenuBlur onItemDestroy onItemAdded onMenuFocus _isNewSource _onWindowError _isNewCategory _printToBrowserConsole _createNewCategory _createNewSource _primeXYFromDOM initEvents initUIComponents initConfig unRegister correctFrame regCE _simpleRemove _getScrollLeft clearCache _simpleAdd useLegacyEvent _isValidCollection getEl _load fireLegacyEvent getLegacyIndex _unload _tryPreloadAttach _getScrollTop startInterval _getScroll _getCacheIndex _ready _getSeriesDefs _loadDataHandler 
syn keyword javaScriptYUIPrivate    _getRequest _setSeriesDefs _setRequest _getDataSource _setDataSource _setCategoryNames _refreshData _getPolling _setPolling _getDataTipFunction _getCategoryNames _setDataTipFunction _run _handleTestObjectComplete _addTestCaseToTestTree _buildTestTree _addTestSuiteToTestTree _runTest show _initViewerDOM _drawChartLegend _dataTableRenderHandler _createButton _refreshDataTable _sortedByChange _initDataTable _toggleVisible hide _initChart _getChartData toString _sizeChartCanvas _thClickHandler _initLauncherDOM _arraySum _createProfilerViewerElement _getSeriesDef _initChartDOM _setBusyState _refreshChart _getProfilerData autoScroll _bumpPendingDown _showMenu submitForm createInputElement _isActivationKey _onFormReset _addListenersToForm _onMouseUp _onOption _setTabIndex 
syn keyword javaScriptYUIPrivate    _onDocumentKeyUp _setChecked _onMenuClick _onMenuItemAdded _setTitle _setHref _onMouseDown _onMenuHide _setMenu _onKeyUp _isSplitButtonOptionKey _onFocus _setOnClick _onMenuShow setAttributesFromSrcElement setFormElementProperties _onOverlayBeforeShow _hideMenu _setLabel _setType _onMenuRender _onDocumentMouseDown _setSelectedMenuItem _onMenuKeyDown _onMenuItemSelected _setTarget _onDocumentMouseUp setAttributeFromDOMAttribute _onBlur _onTextboxKeyPress _selectText _toggleContainerHelpers _initContainer _typeAhead _toggleHighlight _onTextboxFocus _initList _isIgnoreKey _onContainerMouseover _togglePrehighlight _updateValue _populateList _moveSelection _initContainerHelpers _sendQuery _selectItem _onWindowUnload _enableIntervalDetection _toggleContainer _onContainerScroll 
syn keyword javaScriptYUIPrivate    _clearSelection __initProps _cancelIntervalDetection _initListItem _textMatchesOption _onItemMouseover _onTextboxKeyDown _onItemMouseclick _onTextboxBlur _onItemMouseout _onTextboxKeyUp _onContainerMouseout _onIMEDetected _jumpSelection _onContainerResize initTabs _getMonthFromUI _handleDirectionKeys _handleShiftTabKey _updateMonthUI _getYearFromUI _syncMask _setFirstLastElements _show _handleEnterKey __getCfg _handleTabKey _updateYearUI _updateIFrame _handleFQStateChange _initialize _checkIframeLoaded _storeStates _getHash _handleTestRunnerEvent formatMsg _processResults _handleTestRunnerComplete _removeEventListeners 
syn keyword javaScriptDeprecated	escape unescape
syn keyword javaScriptReserved		abstract boolean byte char class const debugger double enum export extends final float goto implements import int interface long native package private protected public short static super synchronized throws transient volatile 




if exists("javaScript_fold")
    syn match	javaScriptFunction      "\<function\>"
    syn region	javaScriptFunctionFold	start="\<function\>.*[^};]$" end="^\z1}.*$" transparent fold keepend

    syn sync match javaScriptSync	grouphere javaScriptFunctionFold "\<function\>"
    syn sync match javaScriptSync	grouphere NONE "^}"

    setlocal foldmethod=syntax
    setlocal foldtext=getline(v:foldstart)
else
    syn keyword	javaScriptFunction      function
    syn match	javaScriptBraces	   "[{}\[\]]"
    syn match	javaScriptParens	   "[()]"
    syn match	javaScriptEquals	   "[=]"
    syn match	javaScriptPlus  	   "[+]"
    syn match	javaScriptDot     	   "[.]"
    syn match	javaScriptComma     	   "[,]"
    syn match	javaScriptColon     	   "[:]"
    syn match	javaScriptSemiColon    	   "[;]"
    syn match	javaScriptSingleQuote  	   "[']"
    syn match	javaScriptQuote  	   "[\"]"
    syn match	javaScriptQuestionMark 	   "[?]"
    syn match	javaScriptDollarSign 	   "[$]"
endif

syn sync fromstart
syn sync maxlines=100

if main_syntax == "javascript"
  syn sync ccomment javaScriptComment
endif

" Define the default highlighting.
" For version 5.7 and earlier: only when not done already
" For version 5.8 and later: only when an item doesn't have highlighting yet
if version >= 508 || !exists("did_javascript_syn_inits")
  if version < 508
    let did_javascript_syn_inits = 1
    command -nargs=+ HiLink hi link <args>
  else
    command -nargs=+ HiLink hi def link <args>
  endif
  HiLink javaScriptComment		Comment
  HiLink javaScriptLineComment		Comment
  HiLink javaScriptCommentTodo		Todo
  HiLink javaScriptSpecial		Special
  HiLink javaScriptStringS		String
  HiLink javaScriptStringD		String
  HiLink javaScriptCharacter		Character
  HiLink javaScriptSpecialCharacter	javaScriptSpecial
  HiLink javaScriptNumber		javaScriptValue
  HiLink javaScriptConditional		Conditional
  HiLink javaScriptRepeat		Repeat
  HiLink javaScriptBranch		Conditional
  HiLink javaScriptOperator		Operator
  HiLink javaScriptType			Type
  HiLink javaScriptStatement		Statement
  HiLink javaScriptFunction		Function
  HiLink javaScriptBraces		Function
  HiLink javaScriptParens               Function
  HiLink javaScriptEquals               Function
  HiLink javaScriptPlus                 Function
  HiLink javaScriptDot                  Function
  HiLink javaScriptComma                Function
  HiLink javaScriptColon                Function
  HiLink javaScriptSemiColon            Function
  HiLink javaScriptSingleQuote          Function
  HiLink javaScriptQuote                Function
  HiLink javaScriptQuestionMark         Function
  HiLink javaScriptError		Error
  HiLink javaScrParenError		javaScriptError
  HiLink javaScriptNull			Keyword
  HiLink javaScriptBoolean		Boolean
  HiLink javaScriptRegexpString		String

  HiLink javaScriptIdentifier		Identifier
  HiLink javaScriptLabel		Label
  HiLink javaScriptException		Exception
  HiLink javaScriptMessage		Keyword
  HiLink javaScriptGlobal		Keyword
  HiLink javaScriptMember		Keyword
  HiLink javaScriptYahoo		Keyword
  HiLink javaScriptDeprecated		Exception 
  HiLink javaScriptReserved		Keyword
  HiLink javaScriptDebug		Debug
  HiLink javaScriptConstant		Label
  HiLink javaScriptCSS  		JSCSS
  HiLink javaScriptDollarSign           DollarSign

  delcommand HiLink
endif

let b:current_syntax = "javascript"
if main_syntax == 'javascript'
  unlet main_syntax
endif

" vim: ts=8

