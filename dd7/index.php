<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title>YUI Test for PictureTrail.com</title>
  <script type="text/javascript" src="../js/yahoo-min.js"></script>
  <script type="text/javascript" src="../js/event-min.js"></script>
  <script type="text/javascript" src="../js/dom-min.js"></script>
  <script type="text/javascript" src="../js/dragdrop-min.js"></script>
  <script type="text/javascript" src="friends.js"></script>
<script type="text/javascript">
    var friendApp;                                                              
    YAHOO.PT.FriendsApp = function() {
        return {
            init: function() {
                friendApp = new YAHOO.PT.Friends(true,
                        ["friendList"]);
            }
        }
    }();

    YAHOO.util.Event.addListener(window, "load", YAHOO.PT.FriendsApp.init);
    </script>
  <style type="text/css">
  .friends { width: 570px; clear: both; }

.friends {
    zoom: 1;
    /* Triggers hasLayout in IE */
    margin: 0;
    padding: 10px 0;
    border: 1px solid #000;
}

.friends:after {
   display: block;
   clear: both;
   visibility: hidden;
   content: '.';
   height: 0;
}



  .friends ul { list-style: none; margin: 0 1em; padding: 0; }
  .friends li {
    float: left; width: 80px; height: 100px;
    overflow: hidden;
    background: url("friend_bg.gif") no-repeat;
   }
  .friends li.highlight {
    background: url("friend_bg_on.gif") no-repeat;
  }
  .friends li div {
    padding: 3px;
  }
  ul.draggable li {
    cursor:  move;
  }
  .friends li div h4 {
   font-size: 11px; font-weight: normal;
   text-align: center; margin: 0; padding: 0;
   overflow: hidden;
  }
  .friends li div .avatar {
    text-align: center;
    height: 64px;
  }
 </style>
 </head>
 <body>
  <div class="friends">
  <ul id="friendList" class="draggable">
   <li id="friend_1">
    <h4>Test 1</h4>
   </li>
   <li id="friend_2">
    <h4>Test 2</h4>
   </li>
   <li id="friend_3">
    <h4>Test 3</h4>
   </li>
   <li id="friend_4">
    <h4>Test 4</h4>
   </li>
   <li id="friend_5">
    <h4>Test 5</h4>
   </li>
   <li id="friend_6">
    <h4>Test 6</h4>
   </li>
   <li id="friend_7">
    <h4>Test 7</h4>
   </li>
   <li id="friend_8">
    <h4>Test 8</h4>
   </li>
   <li id="friend_9">
    <h4>Test 9</h4>
   </li>
   <li id="friend_10">
    <h4>Test 10</h4>
   </li>
   <li id="friend_11">
    <h4>Test 11</h4>
   </li>
   <li id="friend_12">
    <h4>Test 12</h4>
   </li>
  </ul>
  </div>
 </body>
</html>
