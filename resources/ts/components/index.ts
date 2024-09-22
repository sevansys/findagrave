import Shared from './shared/index';
import Widgets from './widgets/index';
import Features from './features/index';

window.addEventListener('alpine:init', () => {
  Shared();
  Features();
  Widgets();
});
