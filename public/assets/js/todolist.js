(function($) {
  'use strict';
  $(function() {
    var todoListItem = $('.todo-list');
    var todoListInput = $('.todo-list-input');
    $('.todo-list-add-btn').on("click", function(event) {
      event.preventDefault();

      var item = $(this).prevAll('.todo-list-input').val();

      if (item) {
        todoListItem.append("<li><div class='form-check'><label class='form-check-label'><input  class='checkbox' type='checkbox'/></label><input type='text'  disabled='' class='form-control' style='background: transparent;border: none;' placeholder='" + item + "' aria-label='" + item + "' value='" + item + "' aria-describedby='basic-addon1'></input></div><i class='remove mdi mdi-close-circle-outline'></i></li>");
        todoListInput.val("");
      }

    });

    todoListItem.on('change', '.checkbox', function() {
      if ($(this).attr('checked')) {
        $(this).removeAttr('checked');
      } else {
        $(this).attr('checked', 'checked');
      }

      $(this).closest("li").toggleClass('completed');

    });

    todoListItem.on('click', '.remove', function() {
      $(this).parent().remove();
    });

  });
})(jQuery);