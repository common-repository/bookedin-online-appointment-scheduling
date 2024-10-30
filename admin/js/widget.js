(function ($) {
    'use strict';

    $(window).load(function () {
        var widgetWrapper = $('.bookedin-widget-wrapper');
        var widgetFont = $('#widget-font');
        var widgetTheme = $('#widget-theme');
        var widgetCustomBackground = $('#widget-custom-background');
        var widgetCustomBarColor = $('#widget-bar-color');
        var colorPicker = $('#bar-color-picker');
        var serviceTitles = $('.service-title');
        var pickerEnabled = false;
        var justSavedWidget = $('#bookedin-just-saved');
        var selectedFont = $('#selected-font');
        var selectedTheme = $('#selected-theme');
        var selectedBackground = $('#selected-background');
        var barTextColor = $('#bar-text-color');
        var saveButton = $('.button-primary');

        initialConfig();

        function initialConfig () {
            handleFontChange(selectedFont.val() || 'arial');
            handleThemeChange(selectedTheme.val() || 'white');
            handleBarColorChange(widgetCustomBarColor.val());

            if (selectedTheme.val() === 'custom') {
                handleBackgroundChange(selectedBackground.val() || 'light');
            }

            initializePicker();
        }

        /**
         * Spy on the font selection and updates the widget accordingly.
         */
        widgetFont.change(function () {
            var selectedFont = $(this).val();
            handleFontChange(selectedFont);
        });

        /**
         * Spy on the theme selection and updates the widget accordingly.
         */
        widgetTheme.change(function () {
            var selectedTheme = $(this).val();
            handleThemeChange(selectedTheme);
        });

        /**
         * Spy on the custom background selection and updates the widget accordingly.
         */
        widgetCustomBackground.change(function () {
            var selectedBackground = $(this).val();
            handleBackgroundChange(selectedBackground);
        });

        $(this).on('saveWidget', function () {
            saveButton.addClass('loading disabled');
            justSavedWidget.val('true');
            $('#widget-step').submit();
        });

        /**
         * Updates widget font.
         * @param {String} font - Selected font.
         */
        function handleFontChange (font) {
            widgetFont.val(font);
            widgetWrapper.css('font-family', font);
        }

        /**
         * Updates widget theme.
         * @param {String} theme - Selected theme.
         */
        function handleThemeChange (theme) {
            widgetTheme.val(theme);
            widgetWrapper.attr('class', 'bookedin-widget-wrapper ' + theme + '-theme');

            if (theme === 'custom') {
                pickerEnabled = true
            } else {
                pickerEnabled = false;
                resetTheme();
            }

            initializePicker();
        }

        /**
         * Updates widget background.
         * @param {String} background - Selected background.
         */
        function handleBackgroundChange (background) {
            widgetCustomBackground.val(background);
            widgetWrapper.removeClass('light-background dark-background');
            widgetWrapper.addClass(background + '-background');
        }

        /**
         * Updates widget bars color.
         * @param {String} color - HEX representation of the color.
         */
        function handleBarColorChange (color) {
            serviceTitles.each(function () {
                $(this).css({
                    'background-color': color,
                    'color': barTextColor.val() || '#3e3e3e'
                });
            });
        }

        /**
         * Resets custom bar color.
         */
        function resetTheme() {
            widgetCustomBarColor.val('');
            serviceTitles.each(function () {
                $(this).removeAttr('style');
            });
        }

        /**
         * Toggle Color picker based on dropdown selection.
         */
        function togglePicker() {
            var pickerPreview = $('.custom-theme-wrapper');

            if (pickerEnabled) {
                pickerPreview.show();
            } else {
                pickerPreview.hide();
            }
        }

        /**
         * Hook picker to DOM.
         */
        function initializePicker() {
            colorPicker.spectrum({
                color: widgetCustomBarColor.val() || '#ff0000',

                move: function(color) {
                    var backgroundColor = color.toHexString();
                    widgetCustomBarColor.val(backgroundColor);

                    setTextColor(color.toRgb(), serviceTitles);
                    handleBarColorChange(backgroundColor);
                }
            });

            togglePicker();
        }

        function setTextColor(color, element) {
            var o = Math.round(((parseInt(color.r) * 299) + (parseInt(color.g) * 587) + (parseInt(color.b) * 114)) /1000);
            var contentColor = o > 150 ? 'black' : 'white';
            var hexColor = contentColor === 'white' ? '#ffffff' : '#626262';

            $(element).css('color', hexColor);
            barTextColor.val(contentColor);
        }
    })

})(jQuery);