import type { Map as MapboxMap, Style } from 'mapbox-gl';

export interface Map {
  isFullscreen: boolean;
  style?: string | Style;
  instance: MapboxMap | null;
  updateStyle(style: string): this;
  setFullscreen(value: boolean): this;
}

export interface MapOptions {
  zoom: number;
  center: [number, number];
  container?: HTMLElement | string;
}
