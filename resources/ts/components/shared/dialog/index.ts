import { AlpineComponent, DirectiveCallback } from 'alpinejs';

export { BrowseLocationsComponent } from './browse-locations';

export interface Dialog {
  show: boolean;
  open(): this;
  close(): this;
  effect(value: boolean): void;
  params: Record<string, unknown> | null;
}

export function DialogComponent(
  show: boolean = false,
  name?: string,
): AlpineComponent<Dialog> {
  return {
    show,
    params: null,

    open(): Dialog {
      this.show = true;
      return this;
    },
    close(): Dialog {
      this.show = false;
      return this;
    },
    init() {
      if (name) {
        window.addEventListener(`open-dialog:${name}`, (event: CustomEvent) => {
          this.show = true;
          this.params = event.detail;
        });
        window.addEventListener(`close-dialog:${name}`, () => {
          this.show = true;
        });
      }

      this.$watch('show', this.effect);
    },
    effect(value: boolean): void {
      if (value) {
        window.lockBodyScroll();
      } else {
        window.unlockBodyScroll();
      }
    },
  };
}

export const DialogDirective: DirectiveCallback = (
  el: HTMLElement,
  { modifiers, expression },
  { cleanup, evaluate },
) => {
  const [dialogName] = modifiers ?? [];

  if (!dialogName) {
    return console.warn('Dialog directive requires a name as first modifier');
  }

  const params: object = expression ? evaluate(expression) : {};

  const handle = (event: MouseEvent) => {
    event.preventDefault();
    window.dispatchEvent(
      new CustomEvent(`open-dialog:${dialogName}`, {
        detail: params,
      }),
    );
  };

  el.addEventListener('click', handle);

  cleanup(() => {
    el.removeEventListener('click', handle);
  });
};
