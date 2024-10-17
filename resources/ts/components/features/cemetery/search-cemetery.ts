import { ErrorResponse, Response } from '../../shared/types';
import type { AlpineComponent, ElementWithXAttributes } from 'alpinejs';

interface AutoCompleteComponent {
  query: string;
  inputValue: string;
}

interface Cemetery {
  id: number;
  name: string;
  image: string;
  photographed: number;
  memorialsCount: number;
  address: string | null;
  alt_name: null | Array<string>;
}

type PossibleResponseErrorKeys = 'cemetery' | 'location_id';

type CemeterySearchResponseErrorType = ErrorResponse<PossibleResponseErrorKeys>;

interface SearchCemetery {
  isCemeterySearchLoading: boolean;
  cemeterySearchErrors: CemeterySearchResponseErrorType | null;

  get isDisabled(): boolean;
  get cemeteryRef(): AlpineComponent<AutoCompleteComponent> | null;
  get locationRef(): AlpineComponent<AutoCompleteComponent> | null;

  onSubmit(event: SubmitEvent): void;
  onDialogSelect(location: DialogSelectedLocation): void;
  writeEvaluationValue(key?: string, value?: unknown): this;
}

interface DialogSelectedLocation {
  id: number;
  type: number;
  text: string;
  path: string;
}

interface SearchCemeteryOptions {
  ajax: boolean;
  evaluateErrorKey?: string;
  evaluationDataKey?: string;
  evaluateLoadingKey?: string;
}

function getDataStack(
  node: ElementWithXAttributes | null,
): AlpineComponent<AutoCompleteComponent> | null {
  return (node?._x_dataStack?.[0] ??
    null) as AlpineComponent<AutoCompleteComponent> | null;
}

export function SearchCemeteryComponent(
  options: SearchCemeteryOptions,
): AlpineComponent<SearchCemetery> {
  return {
    cemeterySearchErrors: null,
    isCemeterySearchLoading: false,

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

    init(): void {
      if (options.evaluateLoadingKey) {
        this.$watch('isCemeterySearchLoading', (value: boolean): void => {
          this.writeEvaluationValue(options.evaluateLoadingKey, value);
        });
      }

      if (options.evaluateErrorKey) {
        this.$watch(
          'cemeterySearchErrors',
          (value: CemeterySearchResponseErrorType | null): void => {
            this.writeEvaluationValue(options.evaluateErrorKey, value);
          },
        );
      }
    },

    onSubmit(event: SubmitEvent): void {
      event.preventDefault();

      const formData = new FormData(this.$el as HTMLFormElement);

      this.isCemeterySearchLoading = true;
      window.axios
        .get<Response<Array<Cemetery>>>('/cemeteries/search', {
          params: Object.fromEntries(formData.entries()),
        })
        .then((response: any) => {
          this.writeEvaluationValue(
            options.evaluationDataKey,
            response.data?.data ?? [],
          );

          this.cemeterySearchErrors = null;
        })
        .catch(({ response }: any) => {
          this.cemeterySearchErrors = response.data ?? null;

          this.writeEvaluationValue(options.evaluationDataKey, null);
        })
        .finally(() => (this.isCemeterySearchLoading = false));
    },

    writeEvaluationValue(key?: string, value: unknown = null): SearchCemetery {
      if (key && key in this) {
        this[key] = value;
      }

      return this;
    },

    onDialogSelect(location: DialogSelectedLocation): void {
      if (this.locationRef) {
        this.locationRef.query = location.path;
        this.locationRef.inputValue = location.id.toString();
      }
    },
  };
}
