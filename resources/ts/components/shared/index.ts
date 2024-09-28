import Alpine from 'alpinejs';

import { DropdownComponent } from './dropdown';
import { ComboboxComponent } from './combobox';
import { TextEditorComponent } from './text-editor';
import { AutoCompleteComponent } from './autocomplete';
import { DialogComponent, BrowseLocationsComponent } from './dialog';

export default () => {
  Alpine.data('dialog', DialogComponent);
  Alpine.data('combobox', ComboboxComponent);
  Alpine.data('dropdown', DropdownComponent);
  Alpine.data('textEditor', TextEditorComponent);
  Alpine.data('autoComplete', AutoCompleteComponent);
  Alpine.data('browseLocations', BrowseLocationsComponent);
};
