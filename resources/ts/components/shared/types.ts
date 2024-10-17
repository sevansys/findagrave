export interface DropdownOptions {
  value?: string;
  placeholder?: string;
}

export interface Dropdown {
  open: boolean;
  value?: string;
  placeholder?: string;

  bindRoot: Record<string, string>;
  bindPanel: Record<string, string>;
  bindActivator: Record<string, string>;
  bindOption: (value: string) => Record<string, string>;

  get selectedLabel(): string | undefined;

  toggle(): void;
  select(value: string): this;
  close(focusAfter?: HTMLElement): void;
  selectRef(): HTMLSelectElement | undefined;
}

export interface Response<T> {
  data: T;
  status: number;
  message: string;
}

export interface ErrorResponse<PossibleKeys extends string> {
  message: string;
  errors: Record<PossibleKeys, Array<string>>;
}
