var menu = document.getElementById('icon_thing');
var popup = document.getElementById('show-thing');
var masque = document.getElementById('masque');
var bar_h = document.getElementById('bar_h');
var bar_v = document.getElementById('bar_v');
// show-thing

menu.addEventListener('click', () => {
    popup.classList.add('anim-expand');
    popup.classList.remove('out-anim-expand');
    popup.style.background = '#00000034';
    masque.style.zIndex = 200;
    menu.style.zIndex = 0;
    menu.style.borderRight = '1px solid #0b773b';
})

masque.addEventListener('click', () => {
    popup.classList.add('out-anim-expand')
    popup.style.background = 'transparent';
    popup.classList.remove('anim-expand')
    masque.style.zIndex = 0;
    menu.style.zIndex = 200;
    menu.style.borderRight = '1px solid transparent'
})

