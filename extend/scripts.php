</main>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>

<script src="../js2/jquery.dm-uploader.js"></script>

<script src="../js2/basic.js"></script>

<script src="../js2/ui-main.js"></script>

<script src="../js2/ui-multiple.js"></script>

<script src="../js/materialize.min.js"></script>

<script src="../js2/sweetalert2.all.min.js"></script>

<script src="../js/buscador.js"></script>


<script>
$(document).ready(function(){
  function load_unseen_notification(view = '')
  {
      $.ajax({
        url:"../extend/fetch.php",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
          $('.notification_list').html(data.notification);
          if (data.unseen_notification > 0) {
            $('.count').html(data.unseen_notification);
          }
        }
      });
  }
  load_unseen_notification();


});

$('.button-collapse').sideNav({
      menuWidth: 300, // Default is 300
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens,
    }
  ); 
  $('.button-collapse2').sideNav({
      menuWidth: 300, // Default is 300
      edge: 'right', // Choose the horizontal origin
      closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens,
    }
  ); 
  
  

  function may(obj, id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}
</script>

<script lenguaje=javascript>
   function update(newsrc){
     document.getElementById("im").src=newsrc
}
</script>
