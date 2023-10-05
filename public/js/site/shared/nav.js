let burger = document.querySelector('.main-top nav .burger')
let navUL = document.querySelector('.main-top nav ul')
let navBlanket = document.querySelector('.main-top nav .nav-blanket')

let closeBtn = document.querySelector('nav ul .close-btn')

burger.addEventListener('click', function(){
    navUL.classList.add('active')
    navBlanket.classList.add('active')
})

navBlanket.addEventListener('click', function(){
    navUL.classList.remove('active')
    navBlanket.classList.remove('active')
})

closeBtn.addEventListener('click', function(){
    navUL.classList.remove('active')
    navBlanket.classList.remove('active')
})













// dropdown

document.addEventListener('click',e => {
    const isDropdownButton = e.target.matches('[data-dropdown-button]')
    if( !isDropdownButton && e.target.closest('[data-dropdown]') != null) return;
    console.log(isDropdownButton);
    let currentDropdown;
    if(isDropdownButton)
    {
        currentDropdown = e.target.closest('[data-dropdown]')
        currentDropdown.classList.toggle('active')
    }

    console.log(currentDropdown);

    document.querySelectorAll("[data-dropdown].active").forEach(dropdown => {
        if(dropdown === currentDropdown) return;
        dropdown.classList.remove('active')
    })
})