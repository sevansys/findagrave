import { AlpineComponent } from 'alpinejs';

interface MemorialSearchOptions {
  expanded?: boolean;
}

interface MemorialsSearch {
  expanded: boolean;
  location: string | null;
  locationId: number | null;
}

export function MemorialsSearchComponent(
  options: MemorialSearchOptions,
): AlpineComponent<MemorialsSearch> {
  return {
    location: null,
    locationId: null,
    expanded: !!options.expanded,
    init() {
      if (this.expanded && screen.width <= 768) {
        this.expanded = false;
      }
    },
  };
}
