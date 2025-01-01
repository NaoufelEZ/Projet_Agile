const avatar = document.querySelector(".avatar");
avatar.addEventListener("click",()=>{
    const toggle = document.querySelector(".toggle");
    toggle.classList.toggle("active");
})
      
      
      const reservationLink = document.querySelector('.sidebar ul li .there');
      reservationLink.addEventListener('click', (e) => {
        e.preventDefault();
        const subMenu = reservationLink.nextElementSibling;
        if (subMenu) {
          reservationLink.classList.toggle('active');
        }
      });
      const add = document.querySelector(".add");
      allCookies = document.cookie;
      tab = allCookies.split(";")
      find = tab.find((e)=> e.includes("add"));
      if(find){
        add.classList.add("active");
        const button = document.querySelector("button");
        button.addEventListener("click",()=>{
          add.classList.remove("active");
        });
      }
      const deletes = document.querySelectorAll('.delete');
      const show = document.querySelector('.show');
      deletes.forEach(element => {
        element.addEventListener("click",(e)=>{
          e.preventDefault();
          show.style.display="block";
          const button = document.querySelectorAll("button");
          button.forEach((elem,i)=>{
            elem.addEventListener("click",()=>{
              if(i === 0){
                location.href = element;
              }
              else{
                show.style.display="none";
              }
            });
          });
        });
      });

