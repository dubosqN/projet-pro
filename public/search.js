const search = instantsearch({
    indexName: 'dev_products',
    searchClient: algoliasearch('XDJVKX7TWN', 'd4440d4b4f96012f0f25ecea529d5809'),
    routing: true,
});

const brandList = instantsearch.widgets.panel({
    templates: {
        header: 'Couleurs',
    },
})(instantsearch.widgets.refinementList);

const categoryMenu = instantsearch.widgets.panel({
    templates: {
        header: 'Categories',
    },
})(instantsearch.widgets.refinementList);

search.addWidgets([

    instantsearch.widgets.searchBox({
        container: '#searchbox',
        placeholder: 'Un produit en particulier ?',
        autofocus: true,
        searchAsYouType: true,
    }),

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
                                            (\{{rating}})
                            </p>
                           </div>
                        </a>
                    </div>
                  `,
        },
    }),
    instantsearch.widgets.clearRefinements({
        container: '#clear-refinements',
        templates: {
            resetLabel: 'Réinitialiser les filtres',
        }
    }),

    instantsearch.widgets.sortBy({
        container: '#sort-by',
        items: [
            { label: 'Prix (Croissant)', value: 'dev_products' },
            { label: 'Prix (Décroissant)', value: 'dev_products_price_desc' },
            { label: 'Nom (A-Z)', value: 'dev_products_A-Z' },
            { label: 'Notes', value: 'dev_products_rating' },
        ],
    }),


    instantsearch.widgets.rangeSlider({
        container: '#range-slider',
        attribute: 'price',
        min: 0,
        max: 4999,
        pips: false,
        tooltips: {
            format(value) {
                return `${Math.round(value).toLocaleString()}€`;
            },
        },
    }),

    brandList({
        container: '#refinement-list',
        attribute: 'couleur.nom',
    }),

    categoryMenu({
        container: '#menu',
        attribute: 'category.name',
    }),

    instantsearch.widgets.currentRefinements({
        container: '#current-refinements',
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
