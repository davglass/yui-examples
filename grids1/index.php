<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Grids with Background Image</title>
        <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
        <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
        <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
    <style type="text/css" media="screen">
#doc {
    background-image: url( bg_main.png );
    background-repeat: repeat-y;
}

#hd, #ft {
    padding: 0 2em;
}

#nav p {
    border: 1px solid black;
    padding: 0 2em;
}

#cont {
    border: 1px solid black;
    margin: 0 2em 0 0;
}

	</style>
</head>
<body>
<div id="doc" class="yui-t2"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
    <div id="hd">
        <!-- start: your content here -->
        <p>MASTHEAD: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.</p>
        <!-- end: your content here -->
    </div>
    <div id="bd">
        <!-- start: primary column from outer template -->
        <div id="yui-main">
            <div class="yui-b">
                <!-- start: stack grids here -->                
                <div class="yui-g" id="cont">
                    <div class="yui-u first">
                        <!-- start: your content here -->
                        <div class="mod">
                            <div class="hd">
                                <h2>Unit A</h2>
                            </div>
                            <div class="hd">
                                <p>GRID UNIT: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat dolor, id aliquam leo tortor eget odio. Pellentesque orci arcu, eleifend at, iaculis sit amet, posuere eu, lorem. Aliquam erat volutpat. Phasellus vulputate. Vivamus id erat. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nunc gravida. Ut euismod, tortor eget convallis ullamcorper, arcu odio egestas pede, ut ornare urna elit vitae mauris. Aenean ullamcorper eros a lacus. Curabitur egestas tempus lectus. Donec et lectus et purus dapibus feugiat. Sed sit amet diam. Etiam ipsum leo, facilisis ac, rutrum nec, dignissim quis, tellus. Sed eleifend.</p>
                            </div>
                        </div>
                        <!-- end: your content here -->
                    </div>
                    <div class="yui-u">
                        <!-- start: your content here -->
                        <div class="mod">
                            <div class="hd">
                                <h2>Unit B</h2>
                            </div>
                            <div class="hd">
                                <p>GRID UNIT: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat dolor, id aliquam leo tortor eget odio. Pellentesque orci arcu, eleifend at, iaculis sit amet, posuere eu, lorem. Aliquam erat volutpat. Phasellus vulputate. Vivamus id erat. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nunc gravida. Ut euismod, tortor eget convallis ullamcorper, arcu odio egestas pede, ut ornare urna elit vitae mauris. Aenean ullamcorper eros a lacus. Curabitur egestas tempus lectus. Donec et lectus et purus dapibus feugiat. Sed sit amet diam. Etiam ipsum leo, facilisis ac, rutrum nec, dignissim quis, tellus. Sed eleifend.</p>
                            </div>
                        </div>
                        <!-- end: your content here -->
                    </div>
                </div>              
                <!-- end: stack grids here -->
            </div>
        </div>
        <!-- end: primary column from outer template -->
        <!-- start: secondary column from outer template -->
        <div class="yui-b" id="nav">
            <!-- start: your content here -->
            <p>SECONDARY: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat dolor, id aliquam leo tortor eget odio. Pellentesque orci arcu, eleifend at, iaculis sit amet, posuere eu, lorem. Aliquam erat volutpat. Phasellus vulputate. Vivamus id erat. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nunc gravida. Ut euismod, tortor eget convallis ullamcorper, arcu odio egestas pede, ut ornare urna elit vitae mauris. Aenean ullamcorper eros a lacus. Curabitur egestas tempus lectus. Donec et lectus et purus dapibus feugiat. Sed sit amet diam. Etiam ipsum leo, facilisis ac, rutrum nec, dignissim quis, tellus. Sed eleifend.</p>
            <!-- end: your content here -->                     
        </div>
        <!-- end: secondary column from outer template -->
    </div>
    <div id="ft">
        <!-- start: your content here -->
        <p>FOOTER: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.</p>
        <!-- end: your content here -->    
    </div>
</div>
</body>
</html>
