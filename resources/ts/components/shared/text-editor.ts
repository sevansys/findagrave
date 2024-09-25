import Quill, { QuillOptionsStatic } from 'quill';
import { AlpineComponent } from 'alpinejs';

interface TextEditor {
  instance: Quill | null;
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
    instance: null,
    init(): void {
      this.instance = new Quill(this.$el, options);
    },
  };
}
