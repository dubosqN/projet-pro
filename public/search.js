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
    instantsearch.widgets.clearRefinements({
        container: '#clear-refinements',
        templates: {
            resetLabel: 'Réinitialiser les filtres',
        }
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
