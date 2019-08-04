</div>


{if !empty($message)}
    {if  $message['type']=='success'}
        <script>success('{$message["title"]}');</script>
    {else}
        {if $message['type']=='warning'}
            <script>warning('{$message["title"]}');</script>
        {else}
            {if $message['type']=='error'}
                <script>error('{$message["title"]}');</script>
            {/if}
        {/if}
    {/if}
{/if}
<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip(); 
    $('.js-example-basic-multiple').select2();
        $('.datepicker').datepicker({
          format: 'dd/mm/yyyy',
          autoclose: true
      })
    $('.js-example-basic-single').select2();
    $(function() {
        $('#table_id').DataTable();
        // $('#tableleft').DataTable();
        // $('#tableright').DataTable();
    })
      checkox =  $('input[type="checkbox"]');
      checkox.change(function(event) {
      	if($(this).is(':checked')){
      		$(this).attr("checked", true);
      	}else{
      		$(this).attr("checked", false);
      	}
      });
</script>  

   </body>
</html>