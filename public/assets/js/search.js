
$(document).ready(function()
{
        var suggestion = {
                input: '',
                normalized: ''
        };
        var city_list = new Bloodhound({
                datumTokenizer: function (d){

                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                        url: APP_URL + '/city?input=',
                        replace: function (url, query) {
                                suggestion.input = query;
                                return url + suggestion.input;
                        },
                        filter: function (data) {
                                return $.map(data, function(v,i) { return { id: v.id,  value: v.value }; });
                                }
                }
        });
        city_list.initialize();

        $('#city').typeahead({
                minLength: 1,
                highlight: true
                },{
                displayKey: 'value',
                source: city_list.ttAdapter(),
                name: 'value',
                    displayKey: 'value',
                    templates: {
                        empty: 'not found'
                    },
                    }).on('typeahead:selected', function() {
                        $('#id_city').val(id);
                    });
                    
                    function onSelected($e, datum){
                        console.log('selected');
                        console.log(datum);
                    }
                    function onAutocompleted($e, datum){
                        console.log('autocompleted');
                        console.log(datum);

                    };




/*var city_list = new Bloodhound({
 datumTokenizer: function(d) { 
     return Bloodhound.tokenizers.whitespace(d.id_city); 
 },
 queryTokenizer: Bloodhound.tokenizers.whitespace,
    limit: 10,
    remote: {
        //url: APP_URL + '/city/' +$("input[name=id_city]").val(),
        url: APP_URL + '/city',
        filter: function(data) {
            return $.map(data, function(v,i){
            return {
                        id: v.id,
                        value: v.value
                    };
        });
        }
    }
});
            city_list.initialize();

            $("#id_city").typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 1
                    }, {
                    source: city_list.ttAdapter(),
                    name: 'value',
                    displayKey: 'value',
                    templates: {
                        empty: 'not found'
                    },
                    });

                    function onSelected($e, datum){
                        console.log('selected');
                        console.log(datum);
                    }
                    function onAutocompleted($e, datum){
                        console.log('autocompleted');
                        console.log(datum);

                    };*/

});