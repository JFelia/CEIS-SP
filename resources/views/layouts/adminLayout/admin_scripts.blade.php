<script type="text/javascript">
     $(document).on('click','#client_bulk_delete',function(){ //for client bulk delete
        var id=[];
        if(confirm("Are you sure you want to delete this Client/s? All it's contacts will be deleted too.")){
          $('.client_checkbox:checked').each(function(){
            id.push($(this).val());
          });
          if(id.length > 0){
            $.ajax({
              url:"{{route('clients.massremove')}}",
              method:"get",
              data:{id:id},
              success:function(data){
                alert(data);
                // $('#sms_table').DataTable().ajax.reload();
                location.reload();
              },
              failed:function(data){
                alert(data);
                location.reload();
              }
            });
          }else{
            alert('Please select atleast one checkbox')
          }
        }
    });
</script>
<script> //script for datatables amd textarea

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $("#compose-textarea").wysihtml5();
    $('#example1').DataTable();
    $('#example2').DataTable();
    $('#example3').DataTable();
    $('#example4').DataTable();
    $('#example5').DataTable();
    $('#example6').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
    CKEDITOR.replace('editor3');
    CKEDITOR.replace('editor4');
    CKEDITOR.replace('editor5');
    CKEDITOR.replace('editor6');
    CKEDITOR.replace('editor7');
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5();


  });

</script>

<script> //script for checkbox and star
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>