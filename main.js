        const avatar = document.querySelector(".avatar");
        avatar.addEventListener("click",()=>{
            const toggle = document.querySelector(".toggle");
            toggle.classList.toggle("active");
        });
        const notification = document.querySelector(".notification");
        const id = notification.getAttribute('data-id');
        const list = document.querySelector(".listNoti");
        notification.addEventListener("click",()=>{
            list.classList.toggle("active");
            fetch(`./notification.php?id=${id}`);
        });
        const lists = document.querySelectorAll(".listNoti li");
        if(lists.length >= 5){
            document.querySelector(".listNoti ul").style.height = "160px";
            document.querySelector(".listNoti ul").style.overflowY= "scroll";
        }