import type { Map as MapboxMap } from 'mapbox-gl';

export interface Map {
  style: string;
  isFullscreen: false;
  instance: MapboxMap | null;
  updateStyle(style: string): this;
  setFullscreen(value: boolean): this;
}

export interface MapOptions {
  zoom: number;
  center: [number, number];
  container?: HTMLElement | string;
}
