(function ($) {
    $(document).ready(function () {
        $('form#ipa-fields-pack-settings-form').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);

            $('#wpbody-content').find('.ajax-process').show();

            var params = {
                action: 'ipa_fields_pack_settings_save',
                ipa_fields_pack_menu_settings_wpnonce: ipa_fields_pack_menu_settings_vars.ipa_fields_pack_menu_settings_wpnonce,
                form: form.serializeArray()
            };

            // $.each(form.serializeArray(), function(){
            //     var name = this.name;
            //
            //     if(this.name.indexOf('[]') !== -1){
            //         name =  name.replace('[]', '');
            //     }
            //
            //     params['form'].push(
            //         {
            //             name: name,
            //             value: this.value
            //         }
            //     );
            // });

            // setup ajax request options
            $.ajaxSetup({
                dataType: "json"
            });

            var ajax_response = $.post(ajaxurl, params);

            ajax_response.success(function (response) {
                if (!$.isEmptyObject(response)) {
                    if ('message' in response) {
                        $('#wpbody-content').find('.wrap-header').append('<div class="notice notice-success ipa-fields-pack-notice"><p>' + response.message + '</p></div>');

                        setTimeout(function () {
                            $('.ipa-fields-pack-notice').slideUp();
                        }, 5000);
                    }

                    if ('fields' in response) {
                        $.each(response['fields'], function (key, value) {
                            form.find("[name='" + key + "']").val(value);
                        });
                    }
                }
            });

            ajax_response.always(function (responce_data) {
                $('#wpbody-content').find('.ajax-process').hide();
            })
        });
    });
})(jQuery);