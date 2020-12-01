import axios from 'axios';

export const request = axios.create({
    baseURL: document.getElementsByName('base-url')[0].getAttribute('content'),
    headers: {
        'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].getAttribute('content')
    }
});
