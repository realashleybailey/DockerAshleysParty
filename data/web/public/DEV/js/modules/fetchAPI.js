import 'whatwg-fetch';

export async function fetchAPI(bodyParemeter, url, method = 'POST') {
    var fetchRequest = '';
    var body = JSON.stringify(bodyParemeter);

    var headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Host': 'ashleybailey.me'
    };

    if (method == 'POST') {
        fetchRequest = await fetch('/api' + url, {
            method,
            headers,
            body,
        });
    }

    if (method == 'GET') {
        fetchRequest = await fetch('/api' + url, {
            method,
            headers,
        });
    }

    if (fetchRequest.ok) {
        return fetchRequest.json();
    }

    const errorBody = await fetchRequest.json();

    if (errorBody.error == undefined) {
        throw errorBody
    }

    throw errorBody.error;
}