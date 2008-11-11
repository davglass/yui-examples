
(function() {
var Y = YAHOO.util;

var TestView = function(widget) {
    this.superApply(widget);
};

TestViewProto = {
    render: function() {
        var panel = this.widget.get('panel');
        panel.set('visible', this.widget.get('active')); // show content if active
    }
};

YAHOO.lang.extend(TestView, YAHOO.widget.WidgetView, TestViewProto);

var TestController = function(widget, view) {
        this.superApply(widget, view);
        console.log('Controller');
};

TestControllerProto = {
    apply: function() {
        // Model
        console.log('HERE', this);
        this.widget.on('titleChange', function(evt) {
            console.log('title changed');
            //this.widget.get('panel').set('visible', evt.newValue);
        }, this, true);

    }
};

YAHOO.lang.extend(TestController, YAHOO.widget.WidgetController, TestControllerProto);

var Test = function(node, attributes) {
    this.constructor.superclass.constructor.apply(this, arguments);
};


Test.NAME = "Test";

Test.CONFIG = {
    title: {
        validator: YAHOO.lang.isString,
        value: ''
    }
};

for (var i = 1; i < 31; i++) {
    Test.CONFIG['attr' + i] = {
        validator: YAHOO.lang.isBoolean,
        value: false
    };
}



TestProto = {
    viewClass: TestView,
    controllerClass: TestController,

    initializer: function(attributes) {
    }
};

YAHOO.lang.extend(Test, YAHOO.widget.Widget, TestProto);


YAHOO.Test = Test;
YAHOO.widget.TestView = TestView;
YAHOO.widget.TestController = TestController;

})();
