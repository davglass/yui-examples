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

