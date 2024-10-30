(function ($) {
    'use strict';

    $(window).load(function () {
        var makingRequest = false;
        var saveButton = $('.button-primary');

        //Preview button.
        var buttonPreview = $('.button-preview');
        var buttonText = $('.bookedin-button .book-now');
        var buttonIcon = $('div.button-icon i');
        var colorPicker = $('#colorpicker');
        var colorDropdown = $('#button-color');
        var sizeDropdown = $('#button-size');
        var sizePreview = $('#bookedin-preview-size');
        var errorMessage = $('.error-message');
        var messageText = $('.message-text');

        //Settings to be saved on WP.
        var settingColor = $('#bookedin-color');
        var settingBottomColor = $('#bookedin-bottom-color');
        var settingTextColor = $('#bookedin-text-color');
        var settingColorName = $('#bookedin-color-name');
        var settingToken = $('#bookedin-token');
        var settingDisplayName = $('#bookedin-name');
        var settingButtonText = $('#bookedin-button-text');
        var justSavedButton = $('#bookedin-just-saved');
        var settingEmail = $('.bookedin-username');
        var pickerEnabled = settingColorName.val() === 'custom';

        initialConfig();

        function initialConfig () {
            sizeDropdown.val(sizePreview.val() || 'standard');
            colorDropdown.val(settingColorName.val() || 'red');
            initializePicker();

            if (buttonPreview) {
                tweakPreview();
            }
        }

        function tweakPreview () {
            $('.button-container').parent().css('padding', '10px 0 0');
        }

        /**
         * Prevent form submit on enter.
         */
        settingEmail.on("keypress", function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $(window).trigger('validateEmail');
            }
        });

        /**
         * Validate user email against bookedin records.
         */
        $(this).on('validateEmail', function () {
            if (makingRequest) {
                return;
            }

            makingRequest = true;

            var baseUrl = pluginConfig.server + pluginConfig.endpoint;
            var key = pluginConfig.apiKey;
            var email = settingEmail.val().trim();
            //var email = 'annualplan1_6mthsin@coldwin.com';
            var fullUrl = baseUrl + '?key=' + key + '&email=' + encodeURIComponent(email);
            var errorEmailMatch = 'Sorry, this email is not linked to a Bookedin account. Try again. ' +
                                  '<br>If the problem persists, please contact <a href="mailto:support@bookedin.com?subject=Help! I can&#39;t set up my WordPress button">support@bookedin.com</a>.';
            var errorInvalidEmail = 'Please enter a valid email.';

            if(validateEmail(email)) {
                $.getJSON(fullUrl, function(data) {
                    settingToken.val(data.token);
                    settingButtonText.val(data.text);
                    settingDisplayName.val(data.displayName);
                    $('#email-form').submit();
                }).fail(function () {
                    messageText.html(errorEmailMatch);
                    errorMessage.addClass('visible');
                    makingRequest = false;
                });
            } else {
                messageText.html(errorInvalidEmail);
                errorMessage.addClass('visible');
                makingRequest = false;
            }
        });

        $(this).on('saveButton', function () {
            saveButton.addClass('loading disabled');
            justSavedButton.val('true');
            $('#button-step').submit();
        });

        function validateEmail(email) {
            // RFC822 RegEx for email validation.
            var re =  /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/;
            return re.test(email);
        }

        /**
         * Spy on the color selection and updates the button accordingly.
         */
        colorDropdown.change(function () {
            $(this).find(':selected').each(function () {
                var selectedColor = $(this).val().toLowerCase();
                var colorHexa;
                var borderHexa;

                pickerEnabled = selectedColor === 'custom';

                switch (selectedColor) {
                    case 'red':
                        colorHexa = '#D52B2B';
                        borderHexa = '#B42424';
                        break;
                    case 'green':
                        colorHexa = '#1EBF3D';
                        borderHexa = '#1A9632';
                        break;
                    case 'blue':
                        colorHexa = '#0071A7';
                        borderHexa = '#004667';
                        break;
                }

                buttonPreview.css({'background-color': colorHexa,
                                   'border-color': borderHexa});
                buttonText.css('color', 'white');
                buttonIcon.attr('class', 'white-icon');
                settingColor.val(colorHexa);
                settingBottomColor.val(borderHexa);
                settingColorName.val(selectedColor);
                settingTextColor.val('#ffffff');
                togglePicker();
            });
        });


        /**
         * Spy on the size selection and updates the button accordingly.
         */
        sizeDropdown.change(function () {
            $(this).find(':selected').each(function () {
                var isSmall = $(this).val().toLowerCase() == 'small';
                if(isSmall) {
                    buttonPreview.addClass('small');
                } else {
                    buttonPreview.removeClass('small');
                }
            });
        });


        /**
         * Toggle Color picker based on dropdown selection.
         */
        function togglePicker() {
            var pickerPreview = $('.sp-replacer');

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
                color: settingColor.val(),

                move: function(color) {
                    var backgroundColor = color.toHexString();
                    var borderColor = shadeColor(backgroundColor, -20);

                    buttonPreview.css({'background-color': backgroundColor,
                        'border-color': borderColor});
                    setTextColor(color.toRgb());

                    settingColor.val(backgroundColor);
                    settingBottomColor.val(borderColor);
                }
            });

            togglePicker();
        }

        /**
         * Takes a color and return a shade of it.
         * Positive percent = lighter
         * Negative percent = darker
         *
         * @param {String} color - HEX value of the color.
         * @param {Number} percent - Shade percent.
         * @returns {String} - Shade HEX value.
         */
        function shadeColor(color, percent) {
            var R = parseInt(color.substring(1,3),16);
            var G = parseInt(color.substring(3,5),16);
            var B = parseInt(color.substring(5,7),16);

            R = parseInt(R * (100 + percent) / 100);
            G = parseInt(G * (100 + percent) / 100);
            B = parseInt(B * (100 + percent) / 100);

            R = (R<255) ? R : 255;
            G = (G<255) ? G : 255;
            B = (B<255) ? B : 255;

            var RR = ((R.toString(16).length==1) ? '0' + R.toString(16) : R.toString(16));
            var GG = ((G.toString(16).length==1) ? '0' + G.toString(16) : G.toString(16));
            var BB = ((B.toString(16).length==1) ? '0' + B.toString(16) : B.toString(16));

            return '#'+RR+GG+BB;
        }

        function setTextColor(color) {
            var o = Math.round(((parseInt(color.r) * 299) + (parseInt(color.g) * 587) + (parseInt(color.b) * 114)) /1000);
            var contentColor = o > 150 ? 'black' : 'white';
            var hexColor = contentColor === 'white' ? '#ffffff' : '#3D3D3D';
            buttonText.css('color', contentColor);
            buttonIcon.attr('class', contentColor + '-icon');
            settingTextColor.val(hexColor);
        }
    })

})(jQuery);
