YAHOO.util.DDM.handleMouseUp = function(e) {
        clearTimeout(this.clickTimeout);
        if (this.dragThreshMet) {
            if (this.fromTimeout) {
                this.fromTimeout = false;
                this.handleMouseMove(e);

            }
            this.fromTimeout = false;
            this.fireEvents(e, true);
        }
        this.stopDrag(e);
        this.stopEvent(e);
};
