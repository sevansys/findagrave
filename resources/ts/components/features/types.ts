import type { Map as MapboxMap, Style } from 'mapbox-gl';

export interface Map {
  isFullscreen: boolean;
  style?: string | Style;
  instance: MapboxMap | null;

  get cemeteryMarkerTemplate(): string | null;
  get cemeteryPopoverTemplate(): string | null;
  get memorialPopoverTemplate(): string | null;

  getTemplateContent(selector: string): string | null;

  initMarkers(): void;
  initCemeteryMarkers(): void;
  initMemorialMarkers(): void;
  updateStyle(style: string): this;
  setFullscreen(value: boolean): this;
  currentLocation(): Promise<GeolocationCoordinates>;
}

export interface MapOptions {
  zoom: number;
  center: [number, number];
  container?: HTMLElement | string;
}
