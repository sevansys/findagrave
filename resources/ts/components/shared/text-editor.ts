import Quill, { QuillOptionsStatic } from 'quill';
import { AlpineComponent } from 'alpinejs';

interface TextEditor {
  instance: Quill | null;
  field: HTMLTextAreaElement | null;
}

interface TextEditorOptions {}

export function TextEditorComponent(
  options: QuillOptionsStatic,
): AlpineComponent<TextEditor> {
  options = {
    modules: {
      toolbar: true,
    },
    theme: 'snow',
    ...options,
  };

  return {
    field: null,
    instance: null,
    init(): void {
      this.instance = new Quill(this.$el, options);
      this.field =
        this.$el.parentElement?.querySelector<HTMLTextAreaElement>(
          'textarea[data-ql-field]',
        ) ?? null;

      this.instance.on('text-change', () => {
        if (this.field && this.instance) {
          this.field.value = this.instance.root.innerHTML;
        }
      });
    },
  };
}
