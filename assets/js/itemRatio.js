class ItemRatioHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
    }

    getDefaultElements() {
    }

    bindEvents() {
        jQuery(document).ready( this.initItemRatio() );
        jQuery(window).resize(this.initItemRatio() );
    }

    initItemRatio(){
        if (!this.getElementSettings( 'item_ratio' )){
            return;
        }
    
        let itemRatio = parseInt(this.getElementSettings( 'item_ratio' ))
        
        let sliderEl = document.querySelector(".elementor-slider-addon");
        sliderEl.classList.add("elementor-has-item-ratio")
        console.log("yau")
        let thumbs = sliderEl.querySelectorAll(".elementor-post__thumbnail")
        thumbs.forEach((curThumb)=>{
            let _img = curThumb.querySelector("img")

            if(_img){
                console.log(curThumb.clientHeight)
                console.log(_img.clientHeight)
                if (curThumb.clientHeight >= _img.clientHeight){
                    curThumb.classList.add("elementor-fit-height")
                }else{
                    curThumb.classList.remove("elementor-fit-height")
                }
            }
        });
        
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const addHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( ItemRatioHandler, {
            $element,
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/elementor-slider-addon.default', addHandler );
} );
