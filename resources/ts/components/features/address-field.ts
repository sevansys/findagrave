import { AlpineComponent } from 'alpinejs';
import { MapboxSearchBox } from '@mapbox/search-js-web';

interface AddressFieldOptions {
  accessToken: string;
}

interface AddressField {
  instance: MapboxSearchBox | null;
}

export function AddressFieldComponent(
  options: AddressFieldOptions,
): AlpineComponent<any> {
  return {
    instance: null,
    init() {
      this.instance = new MapboxSearchBox();
      this.instance.accessToken = options.accessToken;

      this.$el.appendChild(this.instance);

      this.instance.addEventListener('retrieve', (a) => {
        console.log(a.detail);
      });
    },
  };
}
