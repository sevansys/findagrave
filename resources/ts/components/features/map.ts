import mapboxgl from 'mapbox-gl';
import type { MapboxOptions } from 'mapbox-gl';
import type { AlpineComponent } from 'alpinejs';

import type { Map } from './types';

export function MapComponent(options: MapboxOptions): AlpineComponent<Map> {
  return {
    instance: null,
    isFullscreen: false,
    style: options.style,
    async init() {
      if (!options.container) {
        options.container = this.$el;
      }

      if (!options.center) {
        const { longitude, latitude } = await this.currentLocation();
        options.center = [longitude, latitude];
      }

      requestAnimationFrame((): void => {
        this.instance = new mapboxgl.Map(options);
        this.instance.addControl(new mapboxgl.FullscreenControl());
        this.instance.addControl(new mapboxgl.NavigationControl());
      });
    },
    updateStyle(style: string): Map {
      this.instance?.setStyle((this.style = style));
      return this;
    },
    setFullscreen(value: boolean): Map {
      this.isFullscreen = value;
      return this;
    },
    async currentLocation(): Promise<GeolocationCoordinates> {
      return new Promise((resolve, reject) => {
        navigator.geolocation.getCurrentPosition(
          (position: GeolocationPosition) => {
            resolve(position.coords);
          },
          (error) => {
            reject(error);
          },
          {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0,
          },
        );
      });
    },
  };
}
