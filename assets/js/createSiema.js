
class SiemaHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
    }

    getDefaultElements() {
    }

    bindEvents() {
        jQuery(document).ready( this.initSiema() );
    }

    initSiema(){
    
        const siemas = document.querySelectorAll('.siema');
        console.log(siemas);
        for(const siema of siemas) {
    
            siema.style.display = "block"; // Override elementor display fix to block
    
            var arr = siema.querySelectorAll(".siema > *");
            for (let i=0; i< arr.length; i++) {
                arr[i].style.width="100%"; // ovverride element with in column
                arr[i].style.marginTop="0"; // fix elementor margintop post stuff
                arr[i].style.paddingRight="20px"; // Space between Slides
            }
    
    
            function changeSlide() {
                if(siema.getAttribute("hideleft") === "1") {
                    this.innerElements.forEach((slide, i) => {
                        if(i >= this.currentSlide) {
                            this.innerElements[i].classList.remove('gone');
                        } else {
                            this.innerElements[i].classList.add('gone');
                        }
                    })
                }
            }
    
            let New_siema = new Siema({
                perPage: {
                    0: (siema.getAttribute("slidesmobile") != undefined) ? siema.getAttribute("slidesmobile") : "1", 
                    768: (siema.getAttribute("slidestablet") != undefined) ? siema.getAttribute("slidestablet") : "2",
                    1025: (siema.getAttribute("slidesdesktop") != undefined) ? siema.getAttribute("slidesdesktop") : "3"
                },
                onChange: changeSlide,
                overflow:false,
                selector: siema,
            })
    
    
            if(siema.querySelector(".prev") != undefined) {
                let prev = siema.querySelector('.prev');
                prev.addEventListener('click', function(event) {
                    event.preventDefault();
                    New_siema.prev()
                });	}
    
            if(siema.querySelector(".next") != undefined) {
                let next = siema.querySelector('.next');
                next.addEventListener('click', function(event) {
                    event.preventDefault();
                    New_siema.next()
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
