        const avatar = document.querySelector(".avatar");
        const toggle = document.querySelector(".toggle");
        const notification = document.querySelector(".notification");
        if(notification){
            const id = notification.getAttribute('data-id');
            const list = document.querySelector(".listNoti");
            avatar.addEventListener("click",()=>{
                list.classList.remove("active");
                toggle.classList.toggle("active");
            });
            notification.addEventListener("click",()=>{
                toggle.classList.remove("active");
                list.classList.toggle("active");
                fetch(`./notification.php?id=${id}`);
            });
            const lists = document.querySelectorAll(".listNoti li");
            if(lists.length >= 5){
                document.querySelector(".listNoti ul").style.height = "160px";
                document.querySelector(".listNoti ul").style.overflowY= "scroll";
            }
        }
      else{
          avatar.addEventListener("click",()=>{
              toggle.classList.toggle("active");
          });
      }