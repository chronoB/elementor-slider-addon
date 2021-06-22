class ItemRatioHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
    }

    getDefaultElements() {
    }

    bindEvents() {
        jQuery(document).ready( this.initItemRatio() );
    }

    initItemRatio(){
        if (!this.getElementSettings( 'item_ratio' )){
            return;
        }
        checkItemRatio()
    }
}
function checkItemRatio(){
    let sliderEl = document.querySelector(".elementor-slider-addon");
    sliderEl.classList.add("elementor-has-item-ratio")
    let thumbs = sliderEl.querySelectorAll(".elementor-post__thumbnail")
    thumbs.forEach((curThumb)=>{
        let _img = curThumb.querySelector("img")
        if(_img){
            if (curThumb.clientHeight > _img.clientHeight){
                curThumb.classList.add("elementor-fit-height")
            }else if (curThumb.clientHeight = _img.clientHeight) {
                if( curThumb.clientWidth >= _img.clientWidth)
                    curThumb.classList.remove("elementor-fit-height")
            }
        }
    });
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const addHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( ItemRatioHandler, {
            $element,
        } );
    };
    if(typeof elementor !== 'undefined'){
        elementor.channels.editor.on('change',function( view ) {
            var changed = view.elementSettingsModel.changed;
            if (changed.item_ratio || changed.slider_max_height){
                checkItemRatio()
            }
        });
    }

    elementorFrontend.hooks.addAction( 'frontend/element_ready/elementor-slider-addon.default', addHandler );


} );
