import Alpine from 'alpinejs';

import { MapComponent } from './map';
import { AddressFieldComponent } from './address-field';

export default () => {
  Alpine.data('map', MapComponent);
  Alpine.data('addressField', AddressFieldComponent);
};
