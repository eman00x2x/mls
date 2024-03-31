sessionStorage.clear()
let getCollection = async (placement) => {
    let element = document.querySelector('.' + placement);
    if (element !== null) {
        element.classList.remove('d-none');

        if (sessionStorage[placement] !== undefined) {
            const response = JSON.parse(sessionStorage[placement]);
            return response;
        } else {
            const response = await fetch(DOMAIN + 'showAds/' + placement)
                .then(data => data.json());
            sessionStorage[placement] = JSON.stringify(response);
            return response;
        }
        
    }
}

document.addEventListener('DOMContentLoaded', () => {
    let PROPERTY_LIST_TOP = getCollection('PROPERTY_LIST_TOP');
    let PROPERTY_VIEW_SIDEBAR_TOP = getCollection('PROPERTY_VIEW_SIDEBAR_TOP');
    let PROPERTY_VIEW_SIDEBAR_BOTTOM = getCollection('PROPERTY_VIEW_SIDEBAR_BOTTOM');
    let ARTICLE_LIST_SIDEBAR = getCollection('ARTICLE_LIST_SIDEBAR');
    let ARTICLE_VIEW_SIDEBAR = getCollection('ARTICLE_VIEW_SIDEBAR');

    PROPERTY_LIST_TOP.then(data => { setAds('.PROPERTY_LIST_TOP', data); });
    PROPERTY_VIEW_SIDEBAR_TOP.then(data => { setAds('.PROPERTY_VIEW_SIDEBAR_TOP', data); });
    PROPERTY_VIEW_SIDEBAR_BOTTOM.then(data => { setAds('.PROPERTY_VIEW_SIDEBAR_BOTTOM', data); });
    ARTICLE_LIST_SIDEBAR.then(data => { setAds('.ARTICLE_LIST_SIDEBAR', data); });
    ARTICLE_VIEW_SIDEBAR.then(data => { setAds('.ARTICLE_VIEW_SIDEBAR', data); });

});

function setAds(container, data) {
    
    if (data !== undefined) {
        if (data.status == 1) {
            document.querySelector(container + ' a').setAttribute('href', data.current.data.url);
            document.querySelector(container + ' .banner-container').innerHTML = '';
            document.querySelector(container + ' .banner-container').style.setProperty('background-image', 'url(' + data.current.data.banner + ')');
        } else { 
            document.querySelector(container).classList.add('d-none');
        }
    }

}