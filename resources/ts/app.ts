import axios from 'axios';

import Alpine from 'alpinejs';
import Sort from '@alpinejs/sort';
import Focus from '@alpinejs/focus';
import Collapse from '@alpinejs/collapse';

window.axios = axios.create({
  baseURL: '/json',
  withCredentials: true,
});

import './components/index';

Alpine.plugin(Sort);
Alpine.plugin(Focus);
Alpine.plugin(Collapse);

Alpine.start();
