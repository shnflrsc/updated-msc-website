$(document).ready(function () {
  $('.tab').click(function () {
    const selectedTab = $(this).data('tab');
    $('.tab').removeClass('text-[#b9da05] border-b-2 border-[#b9da05] active-tab');
    $('.tab').addClass('text-gray-200'); 

    $(this).addClass('text-[#b9da05] border-b-2 border-[#b9da05]');
    $(this).removeClass('text-gray-200');
    $(this).addClass('active-tab'); 

    $('.tab-content').addClass('hidden');
    $('#tab-' + selectedTab).removeClass('hidden');
  });

  const initialActiveTab = $('.tab.active-tab').data('tab');
  if (initialActiveTab) {
      $('#tab-' + initialActiveTab).removeClass('hidden');
  } else {
      const firstTab = $('.tab').first();
      firstTab.addClass('text-[#b9da05] border-b-2 border-[#b9da05] active-tab');
      firstTab.removeClass('text-gray-200');
      const firstTabName = firstTab.data('tab');
      $('#tab-' + firstTabName).removeClass('hidden');
  }
});