let ticker;

document.addEventListener("DOMContentLoaded", () => { 
    
   getCollection('PROPERTY_LIST_TOP');

});


async function getCollection(placement) { 
    const response = await fetch(DOMAIN + 'showAds/' + placement)
            .then( response => response.json());
    
    if (response.status == 1) { 
        console.log(response);
    }

    
}