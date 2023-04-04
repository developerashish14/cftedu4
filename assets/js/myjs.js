
function update_token2(result)
{
    csrf_token = result.error_token.cname;
    csrf_hash = result.error_token.cvalue;
}
$(document).ready(function(){
    chk_lnnks(window.location.href);
    $('.form-submit').submit(function(e){
        e.preventDefault();
        var frm = $(this);
        frm.find('.frm-error').remove();
        $('#toast-erromsg').html(null).hide();
        frm.find('.border-danger').removeClass('border-danger');
        $('.preloader').show();
        var csrf = frm.find('#csrf-token').val();
        if(csrf && csrf.length > 5) 
        {
            $.ajax({
                url: frm.attr('action'),
                data: new FormData(this),
                type: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function(result){
                    update_token2(result);
					$('input[name='+ csrf_token +']').attr('value',csrf_hash);
                    if(result.success == true){
                        if(result.rlink){
                            window.location.href = result.rlink;
                        }else if(result.alert){
                            frm.before(result.alert);
                        }else if(result.alert1){
                            frm.before(result.alert1);
                            frm.remove();
                        }else{
                            location.reload();
                        }
                    }else{
                        $.each(result.message, function(key,value){
                            var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
                            if(value.length > 2){
                                if(result.border == true){
                                    inpt.addClass('border-danger');
                                    $('#toast-erromsg').show().append(value);
                                }else{
                                    inpt.addClass('border-danger').before(value);
                                }
                            }
                        });
                        setTimeout(function(){
                            $('#toast-erromsg').fadeOut(600)
                        }, 3500);
                    }
                    $('.preloader').hide();
                }
            });
        }
        else
        {
            $('.preloader').hide();
            $('#toast-erromsg').show().append('CSRF Required');
            setTimeout(function(){
                $('#toast-erromsg').fadeOut(600)
            }, 3500);
        }
    });
});

function chk_lnnks(str){
    $('a.nvlnk').each(function(){
        var ctrlnk = $(this).attr('href');
        if(ctrlnk == str){
            $(this).parent('li').addClass('active');
            $(this).parents('li.opn-prn').addClass('active open');
        }
    });
}

function previreImg(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+id).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}