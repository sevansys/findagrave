import Alpine from 'alpinejs';

import { DropdownComponent } from './dropdown';
import { ComboboxComponent } from './combobox';
import { TextEditorComponent } from './text-editor';
import { AutoCompleteComponent } from './autocomplete';
import {
  DialogComponent,
  DialogDirective,
  BrowseLocationsComponent,
} from './dialog';
import { DrawerDirective, DrawerComponent } from './drawer';

export default () => {
  Alpine.directive('dialog', DialogDirective);
  Alpine.directive('drawer', DrawerDirective);

  Alpine.data('drawer', DrawerComponent);
  Alpine.data('dialog', DialogComponent);
  Alpine.data('combobox', ComboboxComponent);
  Alpine.data('dropdown', DropdownComponent);
  Alpine.data('textEditor', TextEditorComponent);
  Alpine.data('autoComplete', AutoCompleteComponent);
  Alpine.data('browseLocations', BrowseLocationsComponent);
};
