import Alpine from 'alpinejs';

import { MapComponent } from './map';
import { MemorialsSearchComponent } from './memorial';
import { ChooseCemeteryComponent, SearchCemeteryComponent } from './cemetery';

export default () => {
  Alpine.data('map', MapComponent);
  Alpine.data('searchCemetery', SearchCemeteryComponent);
  Alpine.data('chooseCemetery', ChooseCemeteryComponent);
  Alpine.data('memorialsSearch', MemorialsSearchComponent);
};
