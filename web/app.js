/**
 * Created by Vince on 27-6-2017.
 */

var EuropeTravelsApp = {
    initialize: function ($wrapper) {
        this.$wrapper = $wrapper;

        this.$wrapper.find('.js-menu-item').on(
            'click',
            this.handleMenuItemClick
        );

        this.$wrapper.find('.js-form-menu-item').on(
            'click',
            this.handleFormMenuItemClick
        );

        this.$wrapper.find('.js-payment-status-row').on(
            'click',
            this.handleRowTitleClick
        );

        this.$wrapper.find('form').on(
            'submit',
            this.handleFormSubmit
        );

        this.$wrapper.find('.js-item-card-title').on(
            'click',
            this.handleCardTitleClick
        );

        this.$wrapper.find('.js-item-title').on(
            'click',
            this.handleTitleClick
        );

        this.$wrapper.find('.js-costs').on(
            'click',
            this.handleCostsClick
        );

        this.$wrapper.find('.js-payment-status-item').on(
            'click',
            this.handlePaymentStatusChange
        );

        this.$wrapper.find('.js-document-wrapper').on(
            'click',
            '.js-remove-document',
            this.handleFormDocumentRemove
        );

        this.$wrapper.find('.js-document-add').on(
            'click',
            this.handleFormDocumentAdd
        );

        this.$wrapper.find('.js-payment-status-buttons-wrapper').find('button').on(
            'click',
            this.handlePaymentChange
        );

        this.$wrapper.find('.js-converter-currency').find('a').on(
            'click',
            this.handleConverterCurrencyChange
        );

        this.$wrapper.find('.js-budget-converter').on(
            'change keyup paste click',
            this.handleConverterChange
        );

        this.$wrapper.find('.js-converter-submit').on(
            'click',
            this.handleConverterSubmit
        );

        this.$wrapper.find('.js-budget-subtract').on(
            'click',
            this.handleBudgetSubtraction
        );
    },

    handleConverterSubmit: function () {
        EuropeTravelsApp.$wrapper.find('.js-converter-submit').slideUp();
        EuropeTravelsApp.$wrapper.find('.js-converter-description-wrapper').slideDown();
    },

    handleBudgetSubtraction: function () {
        var $input = EuropeTravelsApp.$wrapper.find('.js-budget-converter');

        $.ajax({
            url: "/api/budget/subtract",
            method: "POST",
            data: {
                'amount': $input.val() * variables.rates[$input.data('currency').toLowerCase()].eur,
                'description': EuropeTravelsApp.$wrapper.find('.js-converter-description').val()
            },
            success: function () {
                variables.changes.budgetHistory = true;
                RenewApp.budget();
            }
        })
    },

    handleConverterChange: function () {

        var $wrapper = EuropeTravelsApp.$wrapper.find('.js-converter-results-wrapper');

        var base = $(this).data('currency').toLowerCase();
        var amount = $(this).val();
        var budget = $wrapper.data('budget');

        var euro_amount = amount * variables.rates[base].eur;
        var budget_left = budget - euro_amount;
        var budget_today = $wrapper.data('budget-today') - euro_amount;
        var budget_tomorrow = (budget - euro_amount) / ($wrapper.data('days-left') - 1);

        $wrapper.find('.js-converter-eur').text('€ ' +    euro_amount.toLocaleString());
        $wrapper.find('.js-converter-idr').text('IDR ' + (amount * variables.rates[base].idr).toLocaleString());
        $wrapper.find('.js-converter-gbp').text('£ ' +   (amount * variables.rates[base].gbp).toLocaleString());
        $wrapper.find('.js-converter-czk').text('CZK ' + (amount * variables.rates[base].czk).toLocaleString());

        $wrapper.find('.js-converter-budget-eur').text('€ ' +    budget_left.toLocaleString());
        $wrapper.find('.js-converter-budget-idr').text('IDR ' + (budget_left * variables.rates.eur.idr).toLocaleString());
        $wrapper.find('.js-converter-budget-gbp').text('£ ' +   (budget_left * variables.rates.eur.gbp).toLocaleString());
        $wrapper.find('.js-converter-budget-czk').text('CZK ' + (budget_left * variables.rates.eur.czk).toLocaleString());

        $wrapper.find('.js-converter-today-eur').text('€ ' +    budget_today.toLocaleString());
        $wrapper.find('.js-converter-today-idr').text('IDR ' + (budget_today * variables.rates.eur.idr).toLocaleString());
        $wrapper.find('.js-converter-today-gbp').text('£ ' +   (budget_today * variables.rates.eur.gbp).toLocaleString());
        $wrapper.find('.js-converter-today-czk').text('CZK ' + (budget_today * variables.rates.eur.czk).toLocaleString());

        $wrapper.find('.js-converter-tomorrow-eur').text('€ ' +    budget_tomorrow.toLocaleString());
        $wrapper.find('.js-converter-tomorrow-idr').text('IDR ' + (budget_tomorrow * variables.rates.eur.idr).toLocaleString());
        $wrapper.find('.js-converter-tomorrow-gbp').text('£ ' +   (budget_tomorrow * variables.rates.eur.gbp).toLocaleString());
        $wrapper.find('.js-converter-tomorrow-czk').text('CZK ' + (budget_tomorrow * variables.rates.eur.czk).toLocaleString());
    },

    handleConverterCurrencyChange: function (e) {
        e.preventDefault();

        $.ajax({
            url: "/api/converter/" + $(this).data('value'),
            success: function (currency) {
                EuropeTravelsApp.$wrapper.find('.js-budget-converter').data('currency', currency);
                if (currency === 'EUR') {
                    currency = '€';
                } else if (currency === 'GBP') {
                    currency = '£';
                }
                EuropeTravelsApp.$wrapper.find('.js-converter-button').text(currency);
                EuropeTravelsApp.$wrapper.find('.js-budget-converter').click();
            }
        })
    },

    handlePaymentChange: function(e) {

        var $wrapper = $('.js-payment-status-wrapper');
        switch (e.currentTarget.innerText) {
            case 'Base':
                $wrapper.find('.js-payment-status-list-item').each(
                    function () {
                        $(this).text($(this).data('costs-base'))
                    }
                );
                break;
            case 'IDR':
                $wrapper.find('.js-payment-status-list-item').each(
                    function () {
                        $(this).text($(this).data('costs-idr'));
                    }
                );
                $wrapper.find('.js-payment-status-total').each(
                    function () {
                        $(this).text($(this).data('total-idr'))
                    }
                );
                break;
            case 'EUR':
                $wrapper.find('.js-payment-status-list-item').each(
                    function () {
                        $(this).text($(this).data('costs-eur'))
                    }
                );
                $wrapper.find('.js-payment-status-total').each(
                    function () {
                        $(this).text($(this).data('total-eur'))
                    }
                );
                break;

        }
    },

    handleMenuItemClick: function (e) {

        if (e.currentTarget.innerText === 'payments' && variables.changes.paymentStatusList === true) {
            RenewApp.paymentStatusList();
        } else if (e.currentTarget.innerText === 'itinerary' && variables.changes.itinerary === true) {
            RenewApp.itinerary();
        } else if (e.currentTarget.innerText === 'documents' && variables.changes.documentList === true) {
            RenewApp.itinerary();
        }else if (e.currentTarget.innerText === 'history' && variables.changes.budgetHistory === true) {
            RenewApp.budgetHistory();
        }

        $(this).next('div').slideToggle();
        $(this).parent().siblings().children().next().slideUp();
    },

    handleFormMenuItemClick: function () {
        $(this).next().find('.js-form-item').slideToggle();
    },

    handleRowTitleClick: function () {
        var $next = $(this).next();
        $next.slideToggle();
        $next.find('.js-item-card-title').click();
    },

    handleFormSubmit: function (e) {
        e.preventDefault();
        var form = $(this)[0];

        $.ajax({
            url: $(this).closest('div').data('url'),
            data: new FormData(form),
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            success: function (object) {
                form.reset();
                RenewApp.switcher(object.toLowerCase())
            }
        })
    },

    handleCardTitleClick: function() {
        $(this).next().slideToggle();
    },

    handleTitleClick: function() {
        $(this).next().next().slideToggle();
    },

    handleCostsClick: function () {
        var self = $(this);
        var costs = self.data('base-costs');

        switch (self.data('base-currency') + self.data('show-currency')) {
            case 'EUREUR':
                self.text('IDR ' + (costs * variables.rates.eur.idr).toLocaleString());
                self.data('show-currency', 'IDR');
                break;
            case 'EURIDR':
                self.text('€ ' + costs);
                self.data('show-currency', 'EUR');
                break;
            case 'GBPGBP':
                self.text('IDR ' + (costs * variables.rates.gbp.idr).toLocaleString());
                self.data('show-currency', 'IDR');
                break;
            case 'GBPIDR':
                self.text('€ ' + (costs * variables.rates.gbp.eur).toLocaleString());
                self.data('show-currency', 'EUR');
                break;
            case 'GBPEUR':
                self.text('£ ' + costs);
                self.data('show-currency', 'GBP');
                break;
            case 'CZKCZK':
                self.text('IDR ' + (costs * variables.rates.czk.idr).toLocaleString());
                self.data('show-currency', 'IDR');
                break;
            case 'CZKIDR':
                self.text('€ ' + (costs * variables.rates.czk.eur).toLocaleString());
                self.data('show-currency', 'EUR');
                break;
            case 'CZKEUR':
                self.text('CZK ' + costs);
                self.data('show-currency', 'CZK');
                break;
            case 'IDRIDR':
                self.text('€ ' + (costs / variables.rates.eur.idr).toLocaleString());
                self.data('show-currency', 'EUR');
                break;
            case 'IDREUR':
                self.text('IDR ' + costs);
                self.data('show-currency', 'IDR');
                break;
        }
    },

    handlePaymentStatusChange: function(e) {
        e.preventDefault();

        var $self = $(this);
        var paymentStatus = $(this).text();
        var id = $(this).closest('div').data('id');

        $.ajax({
            url: '/api/payment-status',
            data: {
                'id': id,
                'paymentStatus': paymentStatus
            },
            method: 'POST',
            success: function () {
                $('#btnGroupDropCollection' + id).text(paymentStatus);
                $('#btnGroupDropItinerary' + id).text(paymentStatus);
                if ($self.closest('.js-menu-item-wrapper').find('.js-menu-item').text() === 'payments') {
                    RenewApp.paymentStatusList();
                } else {
                    variables.changes.paymentStatusList = true;
                }
            }
        })
    },

    handleFormDocumentRemove: function(e) {
        e.preventDefault();
        $(this).closest('.js-document-item').remove();
    },

    handleFormDocumentAdd: function (e) {
        e.preventDefault();

        var $documentWrapper = $(this).closest('.js-document-wrapper');
        var prototype = $documentWrapper.data('prototype');
        var index = $documentWrapper.data('index');
        var newForm = prototype.replace(/__name__/g, index);
        $documentWrapper.data('index', index + 1);
        $(this).before(newForm);

    }

};

var RenewApp = {
    switcher: function(object) {
        switch (object) {
            case 'transport':
            case 'hotel':
            case 'attraction':
                variables.changes.itinerary = true;
                variables.changes.paymentStatusList = true;
                variables.changes.documentList = true;
                RenewApp.collection(object);
                break;
            case 'payment':
                variables.changes.documentList = true;
                RenewApp.paymentStatusList();
                break;
            case 'document':
                RenewApp.documentList();
                break;
        }
    },

    budgetHistory: function () {
        $.ajax({
            url: "/api/renew/budget-history",
            success: function (response) {
                EuropeTravelsApp.$wrapper.find('.js-budget-history-wrapper').html(response);
            }
        })
    },

    collection: function (entity) {
        $.ajax({
            url: "/api/renew/" + entity,
            success: function (response) {
                var $wrapper = EuropeTravelsApp.$wrapper.find('.js-' + entity + '-wrapper');
                $wrapper.html(response);

                $wrapper.find('.js-item-card-title').on(
                    'click',
                    EuropeTravelsApp.handleCardTitleClick
                );

                $wrapper.find('.js-payment-status-item').on(
                    'click',
                    EuropeTravelsApp.handlePaymentStatusChange
                );

                $wrapper.find('.js-costs').on(
                    'click',
                    EuropeTravelsApp.handleCostsClick
                );

            }
        })
    },

    budget: function () {
        $.ajax({
            url: "/api/renew/budget",
            success: function (response) {
                var $wrapper = EuropeTravelsApp.$wrapper.find('.js-converter-results-wrapper-wrapper');
                $wrapper.html(response);

                $wrapper.find('.js-converter-currency').find('a').on(
                    'click',
                    EuropeTravelsApp.handleConverterCurrencyChange
                );

                $wrapper.find('.js-budget-converter').on(
                    'change keyup paste click',
                    EuropeTravelsApp.handleConverterChange
                );

                $wrapper.find('.js-converter-submit').on(
                    'click',
                    EuropeTravelsApp.handleConverterSubmit
                );

                $wrapper.find('.js-budget-subtract').on(
                    'click',
                    EuropeTravelsApp.handleBudgetSubtraction
                );
            }
        })
    },

    paymentStatusList: function() {
        $.ajax({
            url: "/api/renew/payment",
            success: function (response) {
                var $wrapper = EuropeTravelsApp.$wrapper.find('.js-payment-status-list-wrapper');
                $wrapper.html(response);

                $wrapper.find('.js-payment-status-row').on(
                    'click',
                    EuropeTravelsApp.handleRowTitleClick
                );

                $wrapper.find('.js-item-card-title').on(
                    'click',
                    EuropeTravelsApp.handleCardTitleClick
                );

                $wrapper.find('.js-payment-status-item').on(
                    'click',
                    EuropeTravelsApp.handlePaymentStatusChange
                );

                $wrapper.find('.js-costs').on(
                    'click',
                    EuropeTravelsApp.handleCostsClick
                );

                variables.changes.paymentStatusList = false;
            }
        })
    },

    itinerary: function() {
        $.ajax({
            url: "/api/renew/itinerary",
            success: function (response) {
                var $wrapper = EuropeTravelsApp.$wrapper.find('.js-itinerary-wrapper');
                $wrapper.html(response);

                $wrapper.find('.js-item-card-title').on(
                    'click',
                    EuropeTravelsApp.handleCardTitleClick
                );

                $wrapper.find('.js-payment-status-item').on(
                    'click',
                    EuropeTravelsApp.handlePaymentStatusChange
                );

                $wrapper.find('.js-costs').on(
                    'click',
                    EuropeTravelsApp.handleCostsClick
                );

                variables.changes.paymentStatusList = false;
            }
        })
    },

    documentList: function () {
        $.ajax({
            url: "api/renew/document",
            success: function (response) {
                EuropeTravelsApp.$wrapper.find('.js-document-list-wrapper').html(response);
                variables.changes.documentList = false;
            }
        })
    }
};

$(document).ready(function() {
    var $menu = $('.js-menu');
    EuropeTravelsApp.initialize($menu);
});