import { AlpineComponent } from 'alpinejs';

export { BrowseLocationsComponent } from './browse-locations';

interface Dialog {
  show: boolean;
  open(): this;
  close(): this;
  effect(value: boolean): void;
}

function lockBodyScroll(): void {
  const scrollBarWidth: number =
    window.innerWidth - document.documentElement.clientWidth;

  document.body.style.setProperty('padding-right', `${scrollBarWidth}px`);
  document.body.style.overflowY = 'hidden';
}

function unlockBodyScroll(): void {
  document.body.style.removeProperty('padding-right');
  document.body.style.overflowY = 'auto';
}

export function DialogComponent(
  show: boolean = false,
): AlpineComponent<Dialog> {
  return {
    show,
    open(): Dialog {
      this.show = true;
      return this;
    },
    close(): Dialog {
      this.show = false;
      return this;
    },
    init() {
      this.$watch('show', this.effect);
    },
    effect(value: boolean): void {
      if (value) {
        lockBodyScroll();
      } else {
        unlockBodyScroll();
      }
    },
  };
}
