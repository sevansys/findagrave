<footer class="footer pt-52 pb-36" style="background-image: url({{ asset('/img/footer-bg.png') }})">
  <div class="absolute inset-3 border my-10 w-full md:w-1/2 h-24 flex items-center justify-center mx-auto">
    Content Ad
  </div>

  <div class="max-w-screen-xl mx-auto">
    <section class="footer__top py-2 justify-center gap-4 flex flex-col lg:flex-row border-t border-[#d0ccc1]">
      <x-features.menu.footer.main></x-features.menu.footer.main>
    </section>
    <section class="footer__bottom py-2 flex flex-col lg:flex-row items-center justify-center gap-1 border-t border-[#d0ccc1]">
      <x-shared.copyright></x-shared.copyright>
      <span>·</span>
      <x-features.menu.footer.secondary></x-features.menu.footer.secondary>
    </section>
  </div>
</footer>
