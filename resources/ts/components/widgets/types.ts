export type CemeteriesItemsViewType = 'list' | 'map';

export interface CemeteriesWidget {
  viewType: CemeteriesItemsViewType;

  get viewLabel(): string;
  get isMapView(): boolean;
  get isListView(): boolean;

  toggle(): this;
}

export interface CemeteriesWidgetOptions {
  viewType?: CemeteriesItemsViewType;
}
