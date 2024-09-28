import './components/index';

import axios from 'axios';

import Alpine from 'alpinejs';
import Focus from '@alpinejs/focus';
import Collapse from '@alpinejs/collapse';

window.axios = axios.create({
  baseURL: '/json',
  withCredentials: true,
});

Alpine.plugin(Collapse);
Alpine.plugin(Focus);
Alpine.start();
