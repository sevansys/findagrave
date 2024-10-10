import axios from 'axios';

import Alpine from 'alpinejs';
import Sort from '@alpinejs/sort';
import Focus from '@alpinejs/focus';
import Collapse from '@alpinejs/collapse';

window.axios = axios.create({
  baseURL: '/json',
  withCredentials: true,
});

window.lockBodyScroll = (): void => {
  const scrollBarWidth: number =
    window.innerWidth - document.documentElement.clientWidth;

  document.body.style.setProperty('padding-right', `${scrollBarWidth}px`);
  document.body.style.overflowY = 'hidden';
};

window.unlockBodyScroll = (): void => {
  document.body.style.removeProperty('padding-right');
  document.body.style.overflowY = 'auto';
};

import './components/index';

Alpine.plugin(Sort);
Alpine.plugin(Focus);
Alpine.plugin(Collapse);

Alpine.start();
