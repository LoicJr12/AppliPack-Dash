// --------------------------- Animation dark mode --------------------------------
const navbar = document.querySelector('.navbar');
const darkModeButton = document.querySelector('.link-dark-mode');
const darkModeIcon = document.querySelector('.link-dark-mode i');
const cloudMoonButton = document.querySelector('.fa-cloud-moon');
const listLinkNavbar = document.querySelector('.listLink');
const titleNavBar = document.querySelector('.titleNavbar');

cloudMoonButton.onclick = function(){
    navbar.classList.toggle('dark');
    listLinkNavbar.classList.toggle('dark');
    titleNavBar.classList.toggle('dark');
    const isDark = navbar.classList.contains('dark');
    darkModeIcon.classList = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
    cloudMoonButton.classList = isDark ? 'fa-solid fa-cloud-sun' : 'fa-solid fa-cloud-moon'; 
}

darkModeButton.onclick = function(){
    navbar.classList.toggle('dark');
    listLinkNavbar.classList.toggle('dark');
    titleNavBar.classList.toggle('dark');
    const isDark = navbar.classList.contains('dark');
    darkModeIcon.classList = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
    cloudMoonButton.classList = isDark ? 'fa-solid fa-cloud-sun' : 'fa-solid fa-cloud-moon'; 
}


// ------------------------ Animation menu responsive ------------------------------
const menuButton = document.querySelector('.menu-icon');
const menuIconButton = document.querySelector('.menu-icon i');
const menuResponsive = document.querySelector('.menu-responsive');

menuButton.onclick = function(){
    menuResponsive.classList.toggle('open');
    const isOpen = menuResponsive.classList.contains('open');
    menuIconButton.classList = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
}