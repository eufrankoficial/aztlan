import axios from 'axios';

export const request = axios.create({
    headers: {
        'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].getAttribute('content')
    }
});
