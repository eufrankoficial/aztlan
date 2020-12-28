export const changeLastUrlStringDeviceCode = function (searchBy, changeBy) {
    //TODO: corrigir
    let currentUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    currentUrl = currentUrl.replace(searchBy, changeBy);
    window.history.pushState({ path: currentUrl }, '', currentUrl);

    return currentUrl;
}

export const addCodeDeviceToUrl = function (deviceCode) {
    const currentUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '/' + deviceCode;
    window.history.pushState({ path: currentUrl }, '', currentUrl);

    return currentUrl;
}

export const lastArgumentUrl = window.location.pathname.substring(window.location.pathname.lastIndexOf('/') + 1);
