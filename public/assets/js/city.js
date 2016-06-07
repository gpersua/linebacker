
$(document).ready(function()
{

var city_list = new Bloodhound({
 datumTokenizer: function(d) { 
     return Bloodhound.tokenizers.whitespace(d.id_city); 
 },
 queryTokenizer: Bloodhound.tokenizers.whitespace,
    limit: 10,
    remote: {
        //url: APP_URL + '/city/' +$("input[name=city]").val(),
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
                        displayKey: 'id',
                        highlight: true,
                        minLength: 3
                    }, {
                        source: city_list.ttAdapter(),
                        name: 'city',
                        displayKey: 'value',
                        templates: {
                            empty: 'not found'
                        },

                    });

                    function onSelected($e, datum) {
                        console.log('selected');
                        console.log(datum);



                    }
                    function onAutocompleted($e, datum) {
                        console.log('autocompleted');
                        console.log(datum);

                    };

});