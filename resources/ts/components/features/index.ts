import Alpine from 'alpinejs';

import { MapComponent } from './map';
import { ChooseCemeteryComponent } from './cemetery';

export default () => {
  Alpine.data('map', MapComponent);
  Alpine.data('chooseCemetery', ChooseCemeteryComponent);
};
