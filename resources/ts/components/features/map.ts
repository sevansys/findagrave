import mapboxgl, { Marker, PopupOptions } from 'mapbox-gl';
import type { Map as MapboxMap, MapboxOptions } from 'mapbox-gl';
import type { AlpineComponent } from 'alpinejs';

import type { Map } from './types';

interface Cemetery {
  url: string;
  name: string;
  latitude: string;
  longitude: string;
  memorialsCount: number;
}

interface Memorial {}

interface MapOptions extends MapboxOptions {
  memorials: Array<Memorial>;
  cemeteries: Array<Cemetery>;
}

export function MapComponent(options: MapOptions): AlpineComponent<Map> {
  return {
    instance: null,
    isFullscreen: false,
    style: options.style,

    get cemeteryMarkerTemplate(): string | null {
      return this.getTemplateContent('#cemetery-marker-template');
    },

    get cemeteryPopoverTemplate(): string | null {
      return this.getTemplateContent('#cemetery-popover-template');
    },

    get memorialPopoverTemplate(): string | null {
      return this.getTemplateContent('#memorial-popover-template');
    },

    getTemplateContent(selector: string): string | null {
      return (
        this.$el.querySelector<HTMLTemplateElement>(selector)?.innerHTML ?? null
      );
    },

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

        this.initMarkers();
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
            timeout: 10000,
            maximumAge: 0,
          },
        );
      });
    },
    initMarkers(): void {
      this.initCemeteryMarkers();
      this.initMemorialMarkers();
    },
    initCemeteryMarkers() {
      if (!this.instance) {
        return;
      }

      for (const cemetery of options.cemeteries ?? []) {
        const marker = useMarker(this.instance, cemetery).setCoords(
          cemetery.longitude,
          cemetery.latitude,
        );

        console.log(this.cemeteryMarkerTemplate);
        if (this.cemeteryMarkerTemplate) {
          marker.setContent(this.cemeteryMarkerTemplate);
        }

        if (this.cemeteryPopoverTemplate) {
          marker.setPopover(
            this.cemeteryPopoverTemplate.replace(
              /__X_DATA__/gi,
              `x-data='${JSON.stringify(cemetery)}'`,
            ),
            {
              offset: 15,
            },
          );
        }

        marker.append();
      }
    },
    initMemorialMarkers() {},
  };
}

function useMarker(map: MapboxMap, data: object | null = null) {
  const el = document.createElement('div');

  if (data) {
    el.setAttribute('x-data', JSON.stringify(data));
  }

  const marker = new mapboxgl.Marker(el);

  return {
    setContent(content: string) {
      el.innerHTML = content;
      return this;
    },
    setPopover(content: string, options?: PopupOptions) {
      marker.setPopup(new mapboxgl.Popup(options).setHTML(content));
      return this;
    },
    setCoords(lng: string | number, lat: string | number) {
      marker.setLngLat([
        parseFloat(lng.toString()),
        parseFloat(lat.toString()),
      ]);
      return this;
    },
    append() {
      marker.addTo(map);
      return this;
    },
  };
}
