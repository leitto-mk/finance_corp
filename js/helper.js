const helper = {
    /**
     * get currency and its current price
     * 
     * @return  {object}
     */
    selectCurrency: () => {
        const API_KEY = 'efa820d81d9a4c6bb64b469e432b033e'

        fetch(`https://api.currencyfreaks.com/latest?apikey=${API_KEY}`)
            .then(response => response.json())
            .then(response => console.log(JSON.stringify(response, null, '\t')))
    },

    /**
     * Get First Day of current Month
     * 
     * @return  {string}    string
     */
    firstDayOfMonth: () => {
        let today = new Date()
        return new Date(today.getFullYear(), today.getMonth(), +1).toLocaleDateString('fr-CA')
    },

    /**
     * Get Last Day of current Month
     * 
     * @return  {string}    string
     */
    lastDayOfMonth: () => {
        let today = new Date()
        return new Date(today.getFullYear(), today.getMonth()+1, 0).toLocaleDateString('fr-CA')
    },

    /**
     * converDate parse Date from `YYYY-MM-DD` to `any` specify format
     * for more information, read the doc here:
     * @link    https://momentjs.com/docs/#/parsing/string-format/
     * 
     * @type    {String}    date in `YYYY-MM-DD` format
     * @type    {String}    `any date format` you want to specify. read the doc
     * 
     * @return  {String}    string
    */
    convertDate: (date, format) => {
        return moment(date,'YYYY-MM-DD').format(format)
    },

    /**
     * Turn On Page Loader
     * 
     * @param   {object}  {animate, iconOnly, boxed, target, message,...}. You can see the the rest inside
     */
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

     /**
     * Turn Off Page Loader
     * 
     * @param   {object} options
     */
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

     /**
     * Disable Enter Key for all inputs 
     */
    disableEnterKey: () => {
        $(document).on('keyup keypress', function(e){
            const key = e.keyCode || e.which

            if(key === 13){
                e.preventDefault()
            }
            
            return;
        })
    },

    /**
     * 
     * @param {float} Size in decimal point
     * 
     * @return {void}
     */
    resizePage: size => {
        document.body.style.zoom = size
    }
}

export default helper