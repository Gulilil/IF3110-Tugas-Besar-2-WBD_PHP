let lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;

window.addEventListener(
  "scroll",
  function listenScroll() {
    const scrollTopPosition =
      window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTopPosition > lastScrollTop) {
      this.document.getElementById('navbar').className = "both-navbar-appear";
    } else if (scrollTopPosition < lastScrollTop) {
      this.document.getElementById('navbar').className = "both-navbar-disappear";
    }
    lastScrollTop = scrollTopPosition <= 0 ? 0 : scrollTopPosition;
  },
  false
);
