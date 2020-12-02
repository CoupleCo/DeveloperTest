import axios from 'axios';

class Http {
  
  constructor() {
    let service = axios.create({});
    service.interceptors.request.use((config) => {
      config.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
      return config
    })
    this.service = service;
  }
}

export default new Http;