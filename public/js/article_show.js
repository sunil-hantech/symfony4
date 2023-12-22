$(document).ready(()=>{
  
    $('.js-like-article').on('click',(e)=>{
        e.preventDefault()
        const link=$(e.currentTarget)
        link.toggleClass('fa-heart-o').toggleClass('fa-heart')
        $.ajax({
            method:"POST",
            url:link.attr('href'),
            success:data=>{
                $('.js-like-article-count').html(data.hearts);
            }
        })
    })
})