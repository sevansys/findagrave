import type { AlpineComponent } from 'alpinejs';

import type { Dropdown, DropdownOptions } from './types.js';

export const DropdownComponent = (
  options: DropdownOptions,
): AlpineComponent<Dropdown> => {
  return {
    open: false,
    value: options?.value,
    placeholder: options?.placeholder,

    bindRoot: {
      'x-id': `['dropdown-button']`,
      '@keydown.escape.prevent.stop': 'close($refs.button)',
      '@focusin.window': '!$refs.panel.contains($event.target) && close()',
    },

    bindPanel: {
      'x-ref': 'panel',
      'x-show': 'open',
      'x-transition.origin.top.left': '',
      'x-bind:id': `$id('dropdown-button')`,
      '@click.outside': 'close($refs.button)',
    },

    bindActivator: {
      'x-ref': 'button',
      '@click.prevent': 'toggle()',
      'x-bind:aria-expanded': 'open',
      'x-bind:aria-controls': `$id('dropdown-button')`,
      'x-bind:class': `{ 'dropdown__activator--open': open }`,
    },

    bindOption: (value: string) => ({
      'x-bind:class': `{
        'bg-gray-200': value === '${value}',
      }`,
      '@click.prevent': `select('${value}')`,
    }),

    toggle() {
      if (this.open) {
        return this.close();
      }

      this.$refs.button.focus();
      this.open = true;
    },
    close(focusAfter?: HTMLElement) {
      if (!this.open) {
        return;
      }

      this.open = false;
      focusAfter && focusAfter.focus();
    },

    select(value: string): AlpineComponent<Dropdown> {
      this.value = value;
      this.close();

      return this;
    },

    selectRef(): HTMLSelectElement | undefined {
      return this.$refs.select as HTMLSelectElement | undefined;
    },

    get selectedLabel(): string | undefined {
      return (
        Array.from(this.selectRef()?.options ?? []).find((option) => {
          return option.value === this.value;
        })?.label ?? this.placeholder
      );
    },
  };
};
