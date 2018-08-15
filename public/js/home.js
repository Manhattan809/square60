$(function() {
    $('.form-search').on('submit', sendFormSearch);
    //$('#street-name').on('keyup', loadDataStreet);
    // $('#borough-by-address').on('change', loadDataStreet);

    $('#borough-by-address').on('change', function () {
        $('.street-name').val(null).trigger('change');
    });

    streets();
});

function sendFormSearch(e) {
    var current = $(e.currentTarget);
    var form = current.serializeArray();
    var countDataForm = form.length;
    var action = current.attr('action');
    var formData = {};
    console.log(formData);
    for (var i = 0; i < countDataForm; i++) {
        formData[form[i].name] = form[i].value;
    }

    $.post(action, formData, function (data) {
        if (data.redirect) {
            window.location = data.redirect;
        } else {
            $('.empty-search.error-' + formData.type).fadeIn();
        }
    });

    return false;
}

var streetText = '';
var boroughText = '';
var timeoutStreetText;

function loadDataStreet(e) {
    if (timeoutStreetText) {
        clearInterval(timeoutStreetText);
    }

    var streetName = $('#street-name').val();
    var borough = $('#borough-by-address').val();

    var streetLength = streetName.length;

    if ((streetText !== streetName || boroughText !== borough) && streetLength > 2) {
        streetText = streetName;
        boroughText = borough;

        timeoutStreetText = setTimeout(function() {
            var dataPost = {
                '_token'  : $('meta[name="csrf-token"]').attr('content'),
                'borough' : borough,
                'address' : streetName
            };

            $.post('load-streets', dataPost, function (data) {
                if (data.similar) {
                    console.log(data.similar)
                }
            });
        }, 500);
    }
}

function streets() {
    var select = $('.street-name');
    var action = select.attr('data-action');

    select.select2({
        ajax: {
            delay: 300,
            url: action,
            dataType: 'json',
            data: function (params) {

                var borough = $('#borough-by-address').val();

                var query = {
                    'borough': borough,
                    'address': params.term
                }

                return query;
            },
            processResults: function (data) {
                var options = [];

                var arrayLength = data.similar.length;
                for (var i = 0; i < arrayLength; i++) {
                    options.push({
                        id: data.similar[i],
                        text: data.similar[i]
                    });
                }

                return {
                    results: options
                };
            }
        },
        placeholder: 'Search for a street',
        minimumInputLength: 3,
        width: '300px'
    });
}