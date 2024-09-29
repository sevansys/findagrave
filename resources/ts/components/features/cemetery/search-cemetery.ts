import type { AlpineComponent, ElementWithXAttributes } from 'alpinejs';

interface AutoCompleteComponent {
  query: string;
  inputValue: string;
}

interface SearchCemetery {
  get isDisabled(): boolean;
  get cemeteryRef(): AlpineComponent<AutoCompleteComponent> | null;
  get locationRef(): AlpineComponent<AutoCompleteComponent> | null;

  onDialogSelect(location: DialogSelectedLocation): void;
}

interface DialogSelectedLocation {
  id: number;
  type: number;
  text: string;
  path: string;
}

function getDataStack(
  node: ElementWithXAttributes | null,
): AlpineComponent<AutoCompleteComponent> | null {
  return (node?._x_dataStack?.[0] ??
    null) as AlpineComponent<AutoCompleteComponent> | null;
}

export function SearchCemeteryComponent(): AlpineComponent<SearchCemetery> {
  return {
    get isDisabled(): boolean {
      console.log(this.cemeteryRef);
      return !this.cemeteryRef?.query.length || !this.locationRef?.query.length;
    },
    get cemeteryRef(): AlpineComponent<AutoCompleteComponent> | null {
      return getDataStack(
        this.$el.querySelector<ElementWithXAttributes>('[x-ref="cemetery"]'),
      );
    },

    get locationRef(): AlpineComponent<AutoCompleteComponent> | null {
      return getDataStack(
        this.$el.querySelector<ElementWithXAttributes>('[x-ref="location"]'),
      );
    },

    onDialogSelect(location: DialogSelectedLocation): void {
      if (this.locationRef) {
        this.locationRef.query = location.path;
        this.locationRef.inputValue = location.id.toString();
      }
    },
  };
}
