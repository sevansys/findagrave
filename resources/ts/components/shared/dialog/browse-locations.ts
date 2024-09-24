import { AlpineComponent } from 'alpinejs';
import { Response } from '../types';

interface BrowseLocations {
  selected: Array<BrowseLocation>;
  data: Array<BrowseLocationGroup>;
  titles: Record<EnumBrowseLocation, string>;

  get selectedLocations(): string;
  get selectedLocationId(): number | null;
  get selectedLocation(): BrowseLocation | null;

  clear(): void;
  getTitle(type: EnumBrowseLocation): string;
  select(index: number, location: BrowseLocation): void;
  isSelected(index: number, location: BrowseLocation): boolean;
  isSelectedParent(index: number, location: BrowseLocation): boolean;
  isCurrenSelected(index: number, location: BrowseLocation): boolean;
  fetch<T>(parentId: number | null): Promise<Response<T> | undefined>;
}

const enum EnumBrowseLocation {
  CONTINENT = 1,
  COUNTRY = 2,
  STATE = 3,
  COUNTY = 4,
  CITY = 5,
}

interface BrowseLocation {
  id: number;
  text: string;
  type: EnumBrowseLocation;
}

interface BrowseLocationGroup {
  type: EnumBrowseLocation;
  options: Array<BrowseLocation> | null;
}

function makeEmptyLocation(
  type: EnumBrowseLocation,
  options: Array<BrowseLocation>,
): BrowseLocationGroup {
  return {
    type,
    options,
  };
}

export function BrowseLocationsComponent(): AlpineComponent<BrowseLocations> {
  return {
    data: [],
    selected: [],
    titles: {
      [EnumBrowseLocation.CONTINENT]: 'Continent',
      [EnumBrowseLocation.COUNTRY]: 'Country',
      [EnumBrowseLocation.STATE]: 'State',
      [EnumBrowseLocation.COUNTY]: 'County',
      [EnumBrowseLocation.CITY]: 'City',
    },

    get selectedLocations(): string {
      return Object.values(this.selected)
        .map(({ text }) => {
          return text;
        })
        .join(', ');
    },

    get noneSelected(): boolean {
      return this.selected.length < 2;
    },

    get selectedLocation(): BrowseLocation | null {
      if (this.selected.length < 2) {
        return null;
      }

      return this.selected[this.selected.length - 1];
    },

    get selectedLocationId(): number | null {
      return this.selectedLocation?.id ?? null;
    },

    getTitle(type: EnumBrowseLocation): string {
      console.log(type, this.titles);
      return this.titles[type];
    },
    isSelected(index: number, location: BrowseLocation): boolean {
      return (this.selected[index]?.id ?? null) === location.id;
    },
    isSelectedParent(index: number, location: BrowseLocation): boolean {
      return (
        this.isSelected(index, location) && index !== this.selected.length - 1
      );
    },
    isCurrenSelected(index: number, location: BrowseLocation): boolean {
      return (
        (this.selected[index]?.id ?? null) === location.id &&
        index === this.selected.length - 1
      );
    },
    init() {
      this.fetch<BrowseLocation[]>(null).then((continents) => {
        this.data = [
          makeEmptyLocation(
            EnumBrowseLocation.CONTINENT,
            continents?.data ?? [],
          ),
        ];
      });
    },
    async fetch<T>(parentId: number | null): Promise<Response<T> | undefined> {
      return (
        await axios.get<Response<T>>('/location/children', {
          params: {
            parentId,
          },
        })
      )?.data;
    },
    select(index: number, location: BrowseLocation): void {
      this.selected.splice(index, this.selected.length - index, location);

      this.fetch<BrowseLocation[]>(location.id).then((children) => {
        this.data.splice(location.type);

        const { data } = children ?? {};

        if (data?.length) {
          this.data.push(makeEmptyLocation(location.type + 1, data));
        }
      });
    },

    clear(): void {
      this.data.splice(1);
      this.selected = [];
    },
  };
}
