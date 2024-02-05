;(function(){

  let sticky = false
  let currentPosition = 0

  const imageCounter = $("[data-name='image-counter']").attr("content")

  $("#sticky-navigation").removeClass("hidden")
  $("#sticky-navigation").slideUp(0)
  checkScroll()

  $("#menu-opener").on("click", toggleNav)

  $(".menu-link").on("click", toggleNav)

  setInterval(()=>{
    currentPosition++

    if (currentPosition < imageCounter) {
      currentPosition++
    }else {
      currentPosition = 0
    }
    $("#gallery .inner").css({
      left: "-"+currentPosition*100+"%"
    })
  },6000)

  $(window).scroll(checkScroll)


  function checkScroll(){
    const inBottom = isInBottom()

    if (inBottom && !sticky) {
      sticky = true
      stickNavigation()
    }
    if(!inBottom && sticky){
      sticky = false
      unStickNavigation()
    }
  }
  function toggleNav(){
    $("#responsive-nav ul").toggleClass("active")
    $("#menu-opener").toggleClass("glyphicon-menu-hamburger")
  }

  function stickNavigation(){
    $("#description").addClass("fixed").removeClass("absolute")
    $("#navigation").slideUp("fast")
    $("#sticky-navigation").slideDown("fast")



//Invisible text FIKA
    //$("#textid").addClass("invisible")
//Recover font
  $("#idmenu").addClass("font-tittle")
  }

  function unStickNavigation(){
    $("#description").removeClass("fixed").addClass("absolute")
    $("#navigation").slideDown("fast")
    $("#sticky-navigation").slideUp("fast")
  }


  function isInBottom(){
     const $description = $("#description")
     const descriptionHeight = $description.height()

    return $(window).scrollTop() > $(window).height() - (descriptionHeight * 2)
  }

})()
