$("#menu-opener").on("click", toggleNav)

function toggleNav(){
  $("#responsive-nav ul").toggleClass("active")
  $("#menu-opener").toggleClass("glyphicon-menu-hamburger")
}
