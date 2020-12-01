import $ from 'jquery';

$(function () {

  $('[data-item=likes]').each(function () {
    const $container = $(this);

    $container.on('click', function (e) {
      e.preventDefault();

      if (e.target.classList.contains('btn')) {
        const type = e.target.getAttribute('data-item');

        $.ajax({
          url: `/articles/10/like/${type}`,
          method: 'POST'
        }).then(function (data) {
          $container.data('type', type === 'like' ? 'dislike' : 'like')
          $container.find('.fa-heart').toggleClass('far fas');
          $container.find('[data-item=likesCount]').text(data.likes);
        });
      }

    });
  });

});