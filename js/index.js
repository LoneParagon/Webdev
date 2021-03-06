/*
=============
Navigation
=============
 */
const navOpen = document.querySelector(".nav__hamburger");
const navClose = document.querySelector(".close__toggle");
const menu = document.querySelector(".nav__menu");
const scrollLink = document.querySelectorAll(".scroll-link");
const navContainer = document.querySelector(".nav__menu");

navOpen.addEventListener("click", () => {
  menu.classList.add("open");
  document.body.classList.add("active");
  navContainer.style.left = "0";
  navContainer.style.width = "30rem";
});

navClose.addEventListener("click", () => {
  menu.classList.remove("open");
  document.body.classList.remove("active");
  navContainer.style.left = "-30rem";
  navContainer.style.width = "0";
});

/*
=============
PopUp
=============
 */
const popup = document.querySelector(".popup");
const closePopup = document.querySelector(".popup__close");

if (popup) {
  closePopup.addEventListener("click", () => {
    popup.classList.add("hide__popup");
  });

  window.addEventListener("load", () => {
    setTimeout(() => {
      popup.classList.remove("hide__popup");
    }, 500);
  });
}

/*
=============
Fixed Navigation
=============
 */

const navBar = document.querySelector(".navigation");
const gotoTop = document.querySelector(".goto-top");

// Smooth Scroll
Array.from(scrollLink).map(link => {
  link.addEventListener("click", e => {
    // Prevent Default
    e.preventDefault();

    const id = e.currentTarget.getAttribute("href").slice(1);
    const element = document.getElementById(id);
    const navHeight = navBar.getBoundingClientRect().height;
    const fixNav = navBar.classList.contains("fix__nav");
    let position = element.offsetTop - navHeight;

    if (!fixNav) {
      position = position - navHeight;
    }

    window.scrollTo({
      left: 0,
      top: position,
    });
    navContainer.style.left = "-30rem";
    document.body.classList.remove("active");
  });
});

// Fix NavBar

window.addEventListener("scroll", e => {
  const scrollHeight = window.pageYOffset;
  const navHeight = navBar.getBoundingClientRect().height;
  if (scrollHeight > navHeight) {
    navBar.classList.add("fix__nav");
  } else {
    navBar.classList.remove("fix__nav");
  }

  if (scrollHeight > 300) {
    gotoTop.classList.add("show-top");
  } else {
    gotoTop.classList.remove("show-top");
  }
});

// Shipping

const shipping = document.querySelector(".shipping_checkbox");
const total_sum_junk = $('.total_ship').text();
const total_sum = parseInt(total_sum_junk.substring(1, total_sum_junk.length));

shipping.addEventListener("click", () => {
  if (shipping.checked) {
    $('.shipping_text').text('7$');
    $('.total_ship').text('$'+(total_sum+7));
  }
  else {
    $('.shipping_text').text('0$');
    $('.total_ship').text('$'+(total_sum));
  }
});

// QuantityCart

$('.btn-plus, .btn-minus').on('click', function(e) {
  const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
  const input = $(e.target).closest('.input-group').find('input');
  if (input.is('input')) {
    input[0][isNegative ? 'stepDown' : 'stepUp']()
  }
})

// Dont want to bother with it so just skip

function checkoutAjax(){
  // (A) GET FORM DATA
  var data = new FormData();
  data.append("code", $('.quantityCode').val());
  data.append("action", $('.action').val());
  data.append("quantity", $('.quantity').val()+1);
 
  // (B) AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../php/changeQuantity.php");
  // What to do when server responds
  xhr.onload = function(){ console.log(this.response); };
  xhr.send(data);
 
  // (C) PREVENT HTML FORM SUBMIT
  return false;
}

// Quantity for item not in cart

function notInCart(){
  document.getElementById('cartCheck').innerHTML = '<h3>Not in cart, add first</h3>';
}