var client = algoliasearch("XDJVKX7TWN", "d4440d4b4f96012f0f25ecea529d5809")
var index = client.initIndex('dev_category');
var myAutocomplete = autocomplete('#search-input', {hint: false}, [
    {
        source: autocomplete.sources.hits(index, {hitsPerPage: 5}),
        displayKey: 'name',
        routing: true,
        templates: {
            suggestion: function(suggestion) {
                var sugTemplate = "<a href='/categorie?dev_products%5BrefinementList%5D%5Bcategory.name%5D%5B0%5D="+ suggestion.name +"'>"+ suggestion._highlightResult.name.value +"</a>"
                return sugTemplate;
            }
        }
    }
]).on('autocomplete:selected', function(event, suggestion, dataset) {
    console.log(suggestion, dataset);
});

document.querySelector(".searchbox [type='reset']").addEventListener("click", function() {
    document.querySelector(".aa-input").focus();
    this.classList.add("hide");
    myAutocomplete.autocomplete.setVal("");
});

document.querySelector("#search-input").addEventListener("keyup", function() {
    var searchbox = document.querySelector(".aa-input");
    var reset = document.querySelector(".searchbox [type='reset']");
    if (searchbox.value.length === 0){
        reset.classList.add("hide");
    } else {
        reset.classList.remove('hide');
    }
});