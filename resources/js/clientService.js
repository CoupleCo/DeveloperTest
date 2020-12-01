import axios from 'axios';

export const client = axios.create({
  baseURL: process.env.MIX_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${localStorage.getItem('token')}`
  }
})
