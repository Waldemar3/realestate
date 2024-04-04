import axios from 'axios';
import router from './router/router';

const instance = axios.create({
  baseURL: 'http://localhost/api/',
});

instance.interceptors.request.use(
  function(config) {
    const token = localStorage.getItem('authToken');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  function(error) {
    return Promise.reject(error);
  }
);

instance.interceptors.response.use(
  function(response) {
    if (response.data && response.data.token_expired) {
      router.push({ name: 'Login' });
    }
    return response;
  },
  function(error) {
    return Promise.reject(error);
  }
);

export default instance;