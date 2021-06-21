
class SiemaHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
    }

    getDefaultElements() {
    }

    bindEvents() {
        jQuery(document).ready( this.initSiema() );
    }

    initSiema(){
        var siemaSlider = [];
        var mobileBreakpoint = elementorFrontend.config.responsive.activeBreakpoints.mobile.value;
        var tabletBreakpoint = elementorFrontend.config.responsive.activeBreakpoints.tablet.value;
        
        const siema = this.$element[0].querySelector('.siema');
    
        siema.style.display = "block"; // Override elementor display fix to block

        //set the overflow of the section to hidden to avoid a horizontal scrollbar if there are to many items in the slider or the loop function is active.
        if (this.getElementSettings( 'siema_overflow' )){
            //only set the section overflow to hidden if the siema slider has a visible overflow.
            siema.closest("section").style.overflow = "hidden";
        }

        function changeSlide() {
            var hideLeft =  this.getElementSettings( 'hide-left' )
            if(hideLeft) {
                siemaSlider[siema].innerElements.forEach((slide, i) => {
                    if(i >= siemaSlider[siema].currentSlide) {
                        siemaSlider[siema].innerElements[i].classList.remove('gone');
                    } else {
                        siemaSlider[siema].innerElements[i].classList.add('gone');
                    }
                })
            }
        }
        if(siemaSlider[siema] == undefined){
            siemaSlider[siema] = getSiema(this);
            if (typeof elementor !== 'undefined') {
                let that = this;
                elementor.channels.editor.on('change', (el)=>{
                    var changed = el.elementSettingsModel.changed;
                    if(changed["number-slides"] || changed["number-slides_mobile"] || changed["number-slides_tablet"]  )
                        resetSiema(el)
                });
                
                function resetSiema(el){
                    siemaSlider[siema].destroy(true);
                    siemaSlider[siema] = getSiema(that);
                }
            }
        }

        function getSiema(ctx){
            return new Siema({
                selector: siema,
                duration: ctx.getElementSettings( 'siema_duration' ).size,
                easing: ctx.getElementSettings( 'siema_easing' ),
                perPage: {
                    0: ctx.getElementSettings( 'number-slides_mobile' ) ? parseInt(ctx.getElementSettings( 'number-slides_mobile' )) : 1, 
                    [mobileBreakpoint] : ctx.getElementSettings( 'number-slides_tablet' ) ? parseInt(ctx.getElementSettings( 'number-slides_tablet' )) : 2,
                    [tabletBreakpoint] : ctx.getElementSettings( 'number-slides' ) ? parseInt(ctx.getElementSettings( 'number-slides' )) : 3
                },
                startIndex: parseInt( ctx.getElementSettings( 'siema_startIndex' ) ) - 1,
                draggable: ctx.getElementSettings( 'siema_draggable' ) ? true : false,
                multipleDrag: ctx.getElementSettings( 'siema_multipleDrag' ) ? true : false,
                threshold: ctx.getElementSettings( 'siema_threshold').size,
                loop: ctx.getElementSettings( 'siema_loop' ) ? true : false,
                rtl: ctx.getElementSettings( 'siema_rtl' ) ? true : false,
                onChange: changeSlide,
            })
        }

        if(siema.parentNode.querySelector(".prev")) {
            let prev = siema.parentNode.querySelector('.prev');
            prev.addEventListener('click', function(event) {
                event.preventDefault();
                siemaSlider[siema].prev()
            });	}

        if(siema.parentNode.querySelector(".next")) {
            let next = siema.parentNode.querySelector('.next');
            next.addEventListener('click', function(event) {
                event.preventDefault();
                siemaSlider[siema].next()
            });
        }
    
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const addHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( SiemaHandler, {
            $element,
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/elementor-slider-addon.default', addHandler );


} );
