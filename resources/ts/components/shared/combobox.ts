import { AlpineComponent } from 'alpinejs';

interface ComboboxOption {
  label: string;
  value: string;
}

interface Combobox {
  isOpen: boolean;
  openedWithKeyboard: boolean;
  options: Array<ComboboxOption>;
  selectedOption: ComboboxOption | null;
  getFilteredOptions(query: string): void;
  setSelectedOption(option: ComboboxOption): void;
  handleKeydownOnOptions(event: KeyboardEvent): void;
}

export function ComboboxComponent(
  comboboxData = {
    allOptions: [],
  },
): AlpineComponent<Combobox> {
  return {
    options: comboboxData.allOptions,
    isOpen: false,
    selectedOption: null,
    openedWithKeyboard: false,
    setSelectedOption(option) {
      this.selectedOption = option;
      this.isOpen = false;
      this.openedWithKeyboard = false;
      (this.$refs.hiddenTextField as HTMLInputElement).value = option.value;
    },
    getFilteredOptions(query) {
      this.options = comboboxData.allOptions.filter((option: ComboboxOption) =>
        option.label.toLowerCase().includes(query.toLowerCase()),
      );
      if (this.options.length === 0) {
        this.$refs.noResultsMessage.classList.remove('hidden');
      } else {
        this.$refs.noResultsMessage.classList.add('hidden');
      }
    },
    // if the user presses backspace or the alpha-numeric keys, focus on the search field
    handleKeydownOnOptions(event) {
      if (
        (event.keyCode >= 65 && event.keyCode <= 90) ||
        (event.keyCode >= 48 && event.keyCode <= 57) ||
        event.keyCode === 8
      ) {
        this.$refs.searchField.focus();
      }
    },
  };
}
