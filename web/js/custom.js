function doSearch(){
  $('#blogSearchForm').submit();
}

$(function(){
  $.material.init();

  if($.isFunction($.timeago)){
    $("time.timeago").timeago();
  }

  if($.isFunction($.fancybox)){
    $('.fancybox').fancybox();
  }
})
