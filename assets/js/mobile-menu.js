// Мобильное меню
document.addEventListener('DOMContentLoaded', () => {
  const mobileMenuToggle = document.querySelector('.header__mobile-menu-toggle');
  const menuWrapper = document.querySelector('.header__menu-wrapper');

  if (mobileMenuToggle && menuWrapper) {
    mobileMenuToggle.addEventListener('click', () => {
      const isActive = mobileMenuToggle.classList.contains('active');
      
      if (isActive) {
        mobileMenuToggle.classList.remove('active');
        menuWrapper.classList.remove('active');
      } else {
        mobileMenuToggle.classList.add('active');
        menuWrapper.classList.add('active');
      }
    });

    const menuLinks = menuWrapper.querySelectorAll('a');
    menuLinks.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenuToggle.classList.remove('active');
        menuWrapper.classList.remove('active');
      });
    });

    document.addEventListener('click', (e) => {
      if (!mobileMenuToggle.contains(e.target) && !menuWrapper.contains(e.target)) {
        mobileMenuToggle.classList.remove('active');
        menuWrapper.classList.remove('active');
      }
    });
  }
}); 