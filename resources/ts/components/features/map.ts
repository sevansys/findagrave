import mapboxgl from 'mapbox-gl';
import type { MapboxOptions } from 'mapbox-gl';
import type { AlpineComponent } from 'alpinejs';

import type { Map } from './types';

export function MapComponent(options: MapboxOptions): AlpineComponent<Map> {
  return {
    instance: null,
    isFullscreen: false,
    style: options.style,
    init() {
      if (!options.container) {
        options.container = this.$el;
      }

      this.instance = new mapboxgl.Map(options);
      this.instance.addControl(new mapboxgl.FullscreenControl());
      this.instance.addControl(new mapboxgl.NavigationControl());
    },
    updateStyle(style: string): Map {
      this.instance?.setStyle((this.style = style));
      return this;
    },
    setFullscreen(value: boolean): Map {
      this.isFullscreen = value;
      return this;
    },
  };
}
