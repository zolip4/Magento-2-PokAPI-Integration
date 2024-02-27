define([
    'uiElement',
    'jquery',
    'mage/translate',
    'Magento_Ui/js/modal/alert'
], function (Element, $, $t, message) {
    'use strict';

    return Element.extend({
        defaults: {
            importDone: false,
            isDataImport: '',
            importAction: '',
            isImportDone: false,
            message: '',
            messages: {
                'completed': 'Data imported successfully',
                'failed' : 'Data Import Required'
            }
        },

        initialize: function () {
            this._super();

            this.initMessage();
        },

        initObservable: function () {
            this._super().observe([
                'isDataImport',
                'message',
                'isImportDone'
            ]);

            return this;
        },

        initImportData: function () {
            this.process(this.importAction);
        },

        initMessage: function () {
            this.message(this.messages[this.isDataImport()]);
            this.isImportDone(this.isDataImport() === 'completed')
        },

        process: function (processUrl) {
            $.ajax({
                url: processUrl,
                type: 'POST',
                dataType: 'json',
                data: { form_key: FORM_KEY },
                showLoader: true
            }).done(function (response) {
                if (response.status !== 'completed') {
                    this.importError(response);
                }

                this.isDataImport(response.status);
                this.message(this.messages[response.status]);
                this.isImportDone(this.isDataImport() === 'completed');
            }.bind(this));
        },

        importError: function (response) {
            this.message(this.messages.error);
            message({ content: response.error });
        }
    });
});
