// JavaScript Document
$(document).ready(function()
{
  $('.an-nav li').hover(function()
  {
    $(this).find('.sub').stop().slideDown(500,function(){$(this).css({height:"auto"})});
  },
  function()
  {
    $(this).find('.sub').slideUp(300);
  });

  $('select.link').change(function()
  {
    var url = $.trim($(this).val());
    if(url) window.open(url);
  });

  var an_bn = $('.an-bn').find('object');
  var bd_wd = $('body').width() > 1000 ? $('body').width() : 1000;
  an_bn.attr('width',bd_wd);
  an_bn.find('embed').attr('width',bd_wd);

});
