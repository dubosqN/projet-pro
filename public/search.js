const search = instantsearch({
    indexName: 'dev_products',
    searchClient: algoliasearch('XDJVKX7TWN', 'd4440d4b4f96012f0f25ecea529d5809'),
});


search.addWidgets([

    instantsearch.widgets.searchBox({
        container: '#searchbox',
        placeholder: 'Rechercher un produit...',
        autofocus: true,
        searchAsYouType: true,
    }),
/*    instantsearch.widgets.clearRefinements({
        container: '#clear-refinements',
    }),
    instantsearch.widgets.refinementList({
        container: '#brand-list',
        attribute: 'category',
    }),*/
    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            item: `
        <div class="hero__card">
            <a href="/produits/{{ objectID }}" class="card-href">
               <div class="card-image">
                <img src="{{url}}" alt="{{name}}"/>
               </div>
               <div class="card--body">
                <h5 class="card-title">{{#helpers.highlight}}{ "attribute": "name" }{{/helpers.highlight}}</h5>
                <h4 class="card-prix">\{{price}}€</h4>
                <p class="card-text">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fas fa-star-half checked"></span>
                                (\{{rating}})
                </p>
               </div>
            </a>
        </div>
      `,
        },
    }),
    instantsearch.widgets.pagination({
        container: '#pagination',
        hitsPerPage : '2',
    }),
]);
//{{#helpers.highlight}}{ "attribute": "description" }{{/helpers.highlight}}
search.start();



//profil div
var divs = ["commande_container", "info-container", "mdp-container", "cartes-container"];
var visibleDivId = null;

function divVisibility(divId) {
    if (visibleDivId === divId) {
        visibleDivId = null;
    } else {
        visibleDivId = divId;
    }
    hideNonVisibleDivs();
}

function hideNonVisibleDivs() {
    var i, divId, div;
    for (i = 0; i < divs.length; i++) {
        divId = divs[i];
        div = document.getElementById(divId);
        if (visibleDivId === divId) {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }
}
