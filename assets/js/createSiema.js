
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
        
        const siemas = document.querySelectorAll('.siema');
        for(const siema of siemas) {
    
            siema.style.display = "block"; // Override elementor display fix to block
    
            var arr = siema.querySelectorAll(".siema > *");
            for (let i=0; i< arr.length; i++) {
                arr[i].style.width="100%"; // ovverride element with in column
                arr[i].style.marginTop="0"; // fix elementor margintop post stuff
                arr[i].style.paddingRight="20px"; // Space between Slides
            }

            var hideLeft =  this.getElementSettings( 'hide-left' )
            function changeSlide() {
                if(hideLeft === "1") {
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
                siemaSlider[siema] = new Siema({
                    perPage: {
                        0: (this.getElementSettings( 'number-slides_mobile' ) != undefined) ? this.getElementSettings( 'number-slides_mobile' ) : "1", 
                        [mobileBreakpoint] : (this.getElementSettings( 'number-slides_tablet' ) != undefined) ? this.getElementSettings( 'number-slides_tablet' ) : "2",
                        [tabletBreakpoint] : (this.getElementSettings( 'number-slides' ) != undefined) ? this.getElementSettings( 'number-slides' ) : "3"
                    },
                    onChange: changeSlide,
                    overflow: false,
                    selector: siema,
                })
            }
    
    
            if(siema.parentNode.querySelector(".prev") != undefined) {
                let prev = siema.parentNode.querySelector('.prev');
                prev.addEventListener('click', function(event) {
                    event.preventDefault();
                    siemaSlider[siema].prev()
                });	}
    
            if(siema.parentNode.querySelector(".next") != undefined) {
                let next = siema.parentNode.querySelector('.next');
                next.addEventListener('click', function(event) {
                    event.preventDefault();
                    siemaSlider[siema].next()
                });
            }
    
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
