import Alpine from 'alpinejs';

import { DropdownComponent } from './dropdown';
import { DialogComponent, BrowseLocationsComponent } from './dialog';

export default () => {
  Alpine.data('dialog', DialogComponent);
  Alpine.data('dropdown', DropdownComponent);
  Alpine.data('browseLocations', BrowseLocationsComponent);
};
