import type { AlpineComponent } from 'alpinejs';

import type {
  CemeteriesWidget,
  CemeteriesItemsViewType,
  CemeteriesWidgetOptions,
} from './types';

function getHasWithDefault(defaultValue: string): string {
  return window.location.hash?.substring(1) ?? defaultValue;
}

const CEMETERIES_ITEMS_VIEW_TYPE: Array<CemeteriesItemsViewType> = [
  'list',
  'map',
];

export const CemeteriesWidgetComponent = (
  options: CemeteriesWidgetOptions,
): AlpineComponent<CemeteriesWidget> => {
  let hash: CemeteriesItemsViewType = getHasWithDefault(
    'map',
  ) as CemeteriesItemsViewType;

  if (!CEMETERIES_ITEMS_VIEW_TYPE.includes(hash)) {
    hash = 'map';
  }

  const viewType: CemeteriesItemsViewType = options?.viewType ?? hash;

  return {
    viewType,
    get viewLabel(): string {
      return this.isMapView ? 'View Map' : 'View List';
    },
    get isMapView() {
      return this.viewType === 'map';
    },
    get isListView() {
      return this.viewType === 'list';
    },
    toggle(): CemeteriesWidget {
      this.viewType = this.isMapView ? 'list' : 'map';

      window.history.pushState(
        { viewType: this.viewType },
        this.viewLabel,
        `#${this.viewType}`,
      );

      return this;
    },
  };
};
