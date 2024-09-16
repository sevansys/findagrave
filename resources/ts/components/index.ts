import Shared from './shared/index';
import Widgets from './widgets/index';

window.addEventListener('alpine:init', () => {
  Shared();
  Widgets();
});
