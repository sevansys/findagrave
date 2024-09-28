import type { AxiosError } from 'axios';
import { AlpineComponent } from 'alpinejs';

import { Response } from './types';

interface Suggestion<T> {
  value: T;
  label: string;
}

type AutoCompleteItems<T> = Array<Suggestion<T>>;
type AutoCompleteResult<T> = Response<AutoCompleteItems<T>>;

interface AutoComplete<T> {
  query: string;
  active: boolean;
  isTyped: boolean;
  isLoading: boolean;
  inputValue: string;
  suggestions: AutoCompleteItems<T>;
  activeSuggestion: Suggestion<T> | null;

  get isSuggestionActive(): boolean;

  onBlur(): void;
  request(): void;
  onFocus(): void;
  updateSuggestions(): void;
  marked(text: string): string;
  fetch(): Promise<AutoCompleteResult<T>>;
  selectSuggestion(suggestion: Suggestion<T>): void;
}

interface AutoCompleteOptions {
  params?: object;
  baseUrl: string;
}

export function AutoCompleteComponent<T = unknown>(
  options: AutoCompleteOptions,
): AlpineComponent<AutoComplete<Suggestion<T>>> {
  return {
    query: '',
    active: false,
    isTyped: false,
    inputValue: '',
    suggestions: [],
    isLoading: false,
    activeSuggestion: null,

    get isSuggestionActive(): boolean {
      return this.active && this.isTyped;
    },

    init() {
      this.$watch('query', () => this.request());
    },

    request(): void {
      if (this.query?.length < 3) {
        return;
      }

      this.updateSuggestions();
    },

    onFocus() {
      this.active = true;
      this.request();
    },

    onBlur() {
      this.active = false;
      this.isTyped = false;
    },

    updateSuggestions() {
      this.fetch().then((suggestions) => {
        this.isTyped = true;
        this.suggestions = suggestions.data;
      });
    },
    isActive(suggestion: Suggestion<T>) {
      return (
        JSON.stringify(this.activeSuggestion) === JSON.stringify(suggestion)
      );
    },
    marked(text: string): string {
      return text.replace(
        new RegExp(this.query.trim(), 'gi'),
        (text) => `<mark>${text}</mark>`,
      );
    },
    selectSuggestion(suggestion: Suggestion<T>): void {
      console.log(suggestion);
      this.activeSuggestion = suggestion;
      this.query = suggestion.label;
      this.inputValue = suggestion.value as string;

      this.onBlur();
    },
    async fetch(): Promise<AutoCompleteResult<T>> {
      this.isLoading = true;
      try {
        const response = await axios.get<AutoCompleteResult<T>>(
          options.baseUrl,
          {
            params: {
              like: this.query,
              ...(options?.params ?? {}),
            },
          },
        );

        return response.data;
      } catch (error: AxiosError) {
        return error.response.data;
      } finally {
        this.isLoading = false;
      }
    },
  };
}
