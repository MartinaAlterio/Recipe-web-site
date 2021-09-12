let header = document.querySelector('.header_home');
if(header != null) {
    let over = false;
    window.addEventListener('scroll', () => {
        if(over === false && window.scrollY > header.scrollHeight ) {
            header.classList.add("over_header");
            over = true;
        } else if (over === true && window.scrollY < header.scrollHeight) {
            header.classList.remove("over_header");
            over = false;
        }
    })
}

let flash_messages = document.querySelectorAll('.flash_message');
flash_messages.forEach((flash_message)=> {
    flash_message.addEventListener('click', ()=> {
        flash_message.classList.add('closed');
    })
})