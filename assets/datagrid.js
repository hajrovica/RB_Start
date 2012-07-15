$(function() {
        $('.dg_form :submit').click(function(e){
        e.preventDefault();
        var $form = $(this).parents('form');

        // This block is added to aomodate this jquery feature, button when clicked formed
        // action name btn delted and space is not allowed char, and this error prevents jQuery to work with CI
        // so we get class and split it by ' ' - space and instead of class we pass second part of aray which is "delete" value
        // as wanted in original and we can use btn clas selectro from bootstrap :)
        var actIme = $(this).attr('class');
        var actArr = actIme.split(' ');

        alert(actArr[1]);

        // var action_name = $(this).attr('class').replace("dg_action_","");
        var action_name = actArr[1].replace("dg_action_","");

        var action_control = $('<input type="hidden" name="dg_action['+action_name+']" value=1 />');

        $form.append(action_control);

        var post_data = $form.serialize();
        action_control.remove();

        var script = $form.attr('action')+'/ajax';
        $.post(script, post_data, function(resp){
          if(resp.error){
             alert(resp.error);
          } else {
             switch(action_name){
                case 'delete' :
                   // remove deleted rows from the grid
                   $form.find('.dg_check_item:checked').parents('tr').remove();
                break;
                case 'anotherAction' :
                   // do something else...
                break;
             }
          }
        }, 'json')
        })

    $('.dg_check_toggler').click(function(){
   var checkboxes = $(this).parents('table').find('.dg_check_item');
   if($(this).is(':checked')){
      checkboxes.attr('checked','true');
   } else {
      checkboxes.removeAttr('checked');
   }
    })
})