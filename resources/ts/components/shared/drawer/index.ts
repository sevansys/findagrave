import type { AlpineComponent, DirectiveCallback } from 'alpinejs';

interface DrawerOptions {
  name: string;
  show?: boolean;
}

interface Drawer {
  show: boolean;
  params: object | null;
  open(): this;
  close(): this;
}

export function DrawerComponent(
  options: DrawerOptions,
): AlpineComponent<Drawer> {
  return {
    params: null,
    show: !!options.show,
    open(): Drawer {
      this.show = true;
      return this;
    },
    close(): Drawer {
      this.show = false;
      return this;
    },
    init(): void {
      window.addEventListener(`close-drawer:${options.name}`, () => close());
      window.addEventListener(`open-drawer:${options.name}`, (event: Event) => {
        this.open();
        this.params = event.detail ?? null;
      });

      this.$watch('show', (value: boolean) => {
        window[value ? 'lockBodyScroll' : 'unlockBodyScroll']?.call(undefined);
      });
    },
  };
}

export const DrawerDirective: DirectiveCallback = (
  el: HTMLElement,
  { modifiers, expression },
  { cleanup, evaluate },
) => {
  const [name] = modifiers ?? [];
  if (!name) {
    return console.warn('Drawer directive requires a name as first modifier');
  }

  const params: object = expression ? evaluate(expression) : {};

  const handle = (event: MouseEvent) => {
    event.preventDefault();
    window.dispatchEvent(
      new CustomEvent(`open-drawer:${name}`, {
        detail: params,
      }),
    );
  };

  el.addEventListener('click', handle);

  cleanup(() => {
    el.removeEventListener('click', handle);
  });
};
