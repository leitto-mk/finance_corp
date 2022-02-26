const helper = {
    //Get Currency List
    selectCurrency: () => {
        const API_KEY = 'efa820d81d9a4c6bb64b469e432b033e'

        fetch(`https://api.currencyfreaks.com/latest?apikey=${API_KEY}`)
            .then(response => response.json())
            .then(response => console.log(JSON.stringify(response, null, '\t')))
    },

    //First Day of Month (YYYY-MM-DD)
    firstDayOfMonth: () => {
        let today = new Date()
        return new Date(today.getFullYear(), today.getMonth(), +1).toLocaleDateString('fr-CA')
    },

    //Last Day of Month (YYYY-MM-DD)
    lastDayOfMonth: () => {
        let today = new Date()
        return new Date(today.getFullYear(), today.getMonth()+1, 0).toLocaleDateString('fr-CA')
    },

    /*
    * converDate parse Date from `YYYY-MM-DD` to `any` specify format
    * for more information, read the doc here:
    * https://momentjs.com/docs/#/parsing/string-format/
    * 
    * @param {String} date
    * @param {String} format
    * 
    * return string
    */
    convertDate: (date, format) => {
        return moment(date,'YYYY-MM-DD').format(format)
    },

    //Display Page Loader
    blockUI: options => {
        options = $.extend(true, {}, options);
        var html = '';
        if (options.animate) {
            html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '">' + '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' + '</div>';
        } else if (options.iconOnly) {
            html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""></div>';
        } else if (options.textOnly) {
            html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
        } else {
            html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
        }

        if (options.target) { // element blocking
            var el = $(options.target);
            if (el.height() <= ($(window).height())) {
                options.centerY = true;
            }
            el.block({
                message: html,
                baseZ: options.zIndex ? options.zIndex : 1000,
                centerY: options.centerY !== undefined ? options.centerY : false,
                css: {
                    top: '10%',
                    border: '0',
                    padding: '0',
                    backgroundColor: 'none'
                },
                overlayCSS: {
                    backgroundColor: options.overlayColor ? options.overlayColor : '#94A0B2',
                    opacity: options.boxed ? 0.05 : 0.1,
                    cursor: 'wait'
                }
            });
        } else { // page blocking
            $.blockUI({
                message: html,
                baseZ: options.zIndex ? options.zIndex : 1000,
                css: {
                    border: '0',
                    padding: '0',
                    backgroundColor: 'none'
                },
                overlayCSS: {
                    backgroundColor: options.overlayColor ? options.overlayColor : '#94A0B2',
                    opacity: options.boxed ? 0.05 : 0.1,
                    cursor: 'wait'
                }
            });
        }
    },

    //Undisplay Page Loader
    unblockUI: target => {
        if (target) {
            $(target).unblock({
                onUnblock: function() {
                    $(target).css('position', '');
                    $(target).css('zoom', '');
                }
            });
        } else {
            $.unblockUI();
        }
    },

    //Disable default Enter Key
    disableEnterKey: () => {
        $(document).on('keyup keypress', function(e){
            const key = e.keyCode || e.which

            if(key === 13){
                e.preventDefault()
            }
            
            return;
        })
    }
}

export default helper