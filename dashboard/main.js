    document.addEventListener('DOMContentLoaded', () => {
      const reservationLink = document.querySelector('.sidebar ul li .there');
      reservationLink.addEventListener('click', (e) => {
        e.preventDefault();
        const subMenu = reservationLink.nextElementSibling;
        if (subMenu) {
          reservationLink.classList.toggle('active');
        }
      });
    });
