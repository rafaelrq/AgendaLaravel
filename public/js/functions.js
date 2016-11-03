$(document).ready(function(){
	$('.btn-new').click(function(){
		$('.t_name').removeClass('has-error');
		$('.t_phone').removeClass('has-error');
		$('#menssage_returned').addClass('none');
		
		$('.btn-success').removeClass('edit');
		$('.btn-success').addClass('btn-save');

		$('#myModalLabel').text('Novo contato');
		$('#id_contato').val('');
		$('#name').val('');
		$('#phone').val('');
		$('#email').val('');
		$('#modal_contato').modal('show');
	});

	$('.panel').on('click', '.editar', function() {
		$('#menssage_returned').addClass('none');
		$('.t_name').removeClass('has-error');
		$('.t_phone').removeClass('has-error');
		
		$('.btn-success').removeClass('btn-save');
		$('.btn-success').addClass('edit');

		$('#myModalLabel').text('Editar contato');
		$('#id_contato').val($(this).attr('data-id'));
		$('#name').val($(this).attr('data-name'));
		$('#phone').val($(this).attr('data-phone'));
		$('#email').val($(this).attr('data-email'));

		$('#modal_contato').modal('show');
	});	

	$('.panel').on('click', '.del', function() {
		var formData = {
            id: 	$(this).attr('data-id'),
	    	'_token': $('input[name=_token]').val()
        }

        $.ajax({
            type: 'post',
            url: '/delete',
            data: formData,
            success: function(data) {
            	if ((data.errors)){
                	showMenssage('error', 'Erro ao tentar deletar registro!');
                }
                else {
                	showMenssage('success', 'Registro deletado com sucesso!');

                    $('#menssage_returned').addClass('none');
                    $('.table-contatos tbody').replaceWith(data);
                    $("#modal_contato").modal('hide');
                }
            },
        });
	});	

	$('.modal-footer').on('click', '.edit', function() {
		var formData = {
            name : 	$('#name').val(),
	 		phone: 	$('#phone').val(),
	    	email: 	$('#email').val(),
	    	id: 	$('#id_contato').val(),
	    	'_token': $('input[name=_token]').val()
        }

        $.ajax({
            type: 'post',
            url: '/edit',
            data: formData,
            success: function(data) {
            	if ((data.errors)){
                	if(data.errors.name)
                		$('.t_name').addClass('has-error');
                	else
                		$('.t_name').removeClass('has-error');

                	if(data.errors.phone)
                		$('.t_phone').addClass('has-error');
                	else
                		$('.t_phone').removeClass('has-error');

                	$('#menssage_returned').removeClass('none');
                    $('#menssage_returned .alert').text('Os campos em destaque são obrigatórios');
                }
                else {
                	showMenssage('success', 'Registro alterado com sucesso!');

                    $('#menssage_returned').addClass('none');
                    $('.table-contatos tbody').replaceWith(data);
                    $("#modal_contato").modal('hide');
                }
            },

        });
    });


	$('.modal-footer').on('click', '.btn-save', function() {
		var formData = {
            name : $('#name').val(),
	 		phone: $('#phone').val(),
	    	email: $('#email').val(),
	    	'_token': $('input[name=_token]').val()
        }

        $.ajax({
            type: 'post',
            url: '/add',
            data: formData,
            success: function(data) {
            	console.log(data);
            	if ((data.errors)){
                	if(data.errors.name)
                		$('.t_name').addClass('has-error');
                	else
                		$('.t_name').removeClass('has-error');

                	if(data.errors.phone)
                		$('.t_phone').addClass('has-error');
                	else
                		$('.t_phone').removeClass('has-error');

                	$('#menssage_returned').removeClass('none');
                    $('#menssage_returned .alert').text('Os campos em destaque são obrigatórios');
                }
                else {
                    showMenssage('success', 'Registro criado com sucesso!');

                    $('#menssage_returned').addClass('none');
                    $('.table-contatos tbody').replaceWith(data);
                    $("#modal_contato").modal('hide');
                }
            },

        });
    });
	
	$("input.tel")
        .mask("(99)9999-9999?9")
        .focusout(function (event) {  
	        var target, phone, element;  
	        target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
	        phone = target.value.replace(/\D/g, '');
	        element = $(target);  
	        element.unmask();  
	        if(phone.length > 10) {  
	            element.mask("(99)99999-999?9");  
	        } else {  
	            element.mask("(99)9999-9999?9");  
	        }  
    });

    $('.btn-search').click(function(){
		if($('#value_search').val() != ''){
			var formData = {
	            val_sarch : $('#value_search').val(),
		    	'_token': $('input[name=_token]').val()
	        }

	        $.ajax({
	            type: 'post',
	            url: '/search',
	            data: formData,
	            success: function(data) {
	            	if ((data.errors)){
	                	if(data.errors.name)
	                		$('.t_name').addClass('has-error');
	                	else
	                		$('.t_name').removeClass('has-error');

	                	if(data.errors.phone)
	                		$('.t_phone').addClass('has-error');
	                	else
	                		$('.t_phone').removeClass('has-error');

	                	$('#menssage_returned').removeClass('none');
	                    $('#menssage_returned .alert').text('Os campos em destaque são obrigatórios');
	                }
	                else {
	                    $('#menssage_returned').addClass('none');
	                    $('.table-contatos tbody').replaceWith(data);
	                    $("#modal_contato").modal('hide');
	                }
	            },

	        });
		}else
			showMenssage('info', 'Favor informar um valor para pesquisa!');

	});
});

function showMenssage(type, msg, time = true){
	var class_message = 'alert-info';

	if(type == 'success')
		class_message = 'alert-success';
	else if(type == 'error')
		class_message = 'alert-danger';
	else if(type == 'info')
		class_message = 'alert-info';

	$('#system_message .alert').attr('class', 'text-msg-system alert ' + class_message).html(msg);
	$('#system_message').attr('class', 'row').attr('style','');
	
	if(time)
		msg_system_timout = setTimeout("$('#system_message').fadeOut(5000)", 5000);
}