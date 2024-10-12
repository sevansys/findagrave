import Alpine from 'alpinejs';

import { CemeteriesWidgetComponent } from './cemeteries-widget';
import { SearchForDuplicatesComponent } from './search-for-duplicates';

export default () => {
  Alpine.data('cemeteriesWidget', CemeteriesWidgetComponent);
  Alpine.data('searchForDuplicates', SearchForDuplicatesComponent);
};
