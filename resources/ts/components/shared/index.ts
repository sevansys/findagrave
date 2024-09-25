import Alpine from 'alpinejs';

import { DropdownComponent } from './dropdown';
import { TextEditorComponent } from './text-editor';
import { DialogComponent, BrowseLocationsComponent } from './dialog';

export default () => {
  Alpine.data('dialog', DialogComponent);
  Alpine.data('dropdown', DropdownComponent);
  Alpine.data('textEditor', TextEditorComponent);
  Alpine.data('browseLocations', BrowseLocationsComponent);
};
