import type { AlpineComponent } from 'alpinejs';

import type { Response } from '../shared/types';

type RequestQuery = Record<string, FormDataEntryValue>;

interface Cemetery {
  id: number;
  name: string;
  image: string;
  photographed: number;
  memorialsCount: number;
  address: string | null;
  alt_name: null | Array<string>;
}

interface SearchForDuplicates {
  data: null;
  isLoading: boolean;
  error: null | string;
  root: null | HTMLElement;

  get formData(): FormData;
  get query(): RequestQuery;
  get createNewCemeteryUrl(): string;

  onSubmit(): void;
}

export function SearchForDuplicatesComponent(): AlpineComponent<SearchForDuplicates> {
  return {
    data: null,
    root: null,
    error: null,
    isLoading: false,

    get formData(): FormData {
      return new FormData(
        this.root?.querySelector('#search-for-duplicates') ?? undefined,
      );
    },

    get query(): RequestQuery {
      return Object.fromEntries(this.formData.entries());
    },

    get createNewCemeteryUrl(): string {
      return `${window.location.pathname}?${new URLSearchParams(this.query)}`;
    },

    init(): void {
      this.root = this.$el;
    },

    onSubmit(): void {
      this.isLoading = true;
      window.axios
        .get<Response<Array<Cemetery>>>('/cemeteries/search', {
          params: this.query,
        })
        .then((response: any) => {
          this.data = response.data?.data ?? [];
          this.error = null;
        })
        .catch(({ response }: any) => {
          this.data = null;
          this.error = response.data?.message ?? null;
        })
        .finally(() => (this.isLoading = false));
    },
  };
}
