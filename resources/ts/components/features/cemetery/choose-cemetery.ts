import { AlpineComponent } from 'alpinejs';
import { Response } from '../../shared/types';

interface CemeteryInterface {
  name: string;
  image: string;
  address: string;
  alt_names: string;
}

interface ChooseCemetery {
  page: number | null;
  locationId: number | null;
  data: Array<CemeteryInterface>;
  next(): Promise<Response<CemeteryInterface> | null>;
  fetch(page: number): Promise<Response<CemeteryInterface> | null>;
}

interface CemeteryComponentOptions {
  page: number | null;
  locationId: number | null;
}

export function ChooseCemeteryComponent(
  options: CemeteryComponentOptions,
): AlpineComponent<ChooseCemetery> {
  return {
    data: [],
    page: null,
    locationId: null,
    async fetch(page: number = 1): Promise<Response<CemeteryInterface> | null> {
      this.page = page;

      return (
        (
          await axios.get<Response<CemeteryInterface>>(
            `/json/cemeteries/${this.locationId ?? ''}`,
            {
              params: {
                page: this.page,
              },
            },
          )
        )?.data ?? null
      );
    },
    next(): Promise<Response<CemeteryInterface> | null> {
      return this.fetch(!this.page ? 1 : ++this.page);
    },
  };
}
