import Alpine from 'alpinejs';

import { MapComponent } from './map';

export default () => {
  Alpine.data('map', MapComponent);
};
