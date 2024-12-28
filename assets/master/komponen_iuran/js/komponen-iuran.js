var ki = {
	startUp: function(){
		// ki.getLists();
	}, // end - startUp

	addForm: function() {
		$.get('master/KomponenIuran/addForm',{
			},function(data){
			var _options = {
				className : 'veryWidth',
				message : data,
				size : 'large',
			};
			bootbox.dialog(_options).bind('shown.bs.modal', function(){
				// $(this).find('.modal-dialog').css(
				// 	'max-width','80%'
				// );

				var modal_body = $(this).find('.modal-body');
				var table = $(modal_body).find('table');
				var tbody = $(table).find('tbody');
				if ( $(tbody).find('.modal-body tr').length <= 1 ) {
			        $(this).find('tr #btn-remove').addClass('hide');
			    };
			});
		},'html');
	}, // end - add_form

	edit_form: function(elm) {
		var btn_edit = $(elm);
		var tr = $(btn_edit).closest('tr');
		var id_fitur = $(tr).find('td.id_fitur').html();

		$.get('master/KomponenIuran/edit_form',{
			id_fitur: id_fitur,
			},function(data){
			var _options = {
				className : 'veryWidth',
				message : data,
				size : 'large',
			};
			bootbox.dialog(_options).bind('shown.bs.modal', function(){
				// $(this).find('.modal-dialog').css(
				// 	'max-width','80%'
				// );

				var modal_body = $(this).find('.modal-body');
				var table = $(modal_body).find('table');
				var tbody = $(table).find('tbody');
				if ( $(tbody).find('tr').length <= 1 ) {
			        $(tbody).find('tr #btn-remove').addClass('hide');
			    };
			});
		},'html');
	}, // end - edit_form

	getLists : function(keyword = null){
		$.ajax({
			url : 'master/KomponenIuran/list_fitur',
			data : {'keyword' : keyword},
			dataType : 'HTML',
			type : 'GET',
			beforeSend : function(){ showLoading(); },
			success : function(data){
				$('table.tbl_fitur tbody').html(data);
				ki.showHideDetail();
				hideLoading();
			}
		});
	}, // end - getLists

	save: function () {
		var err = 0;
		$.map( $('input[data-required=1]'), function(input){
			if ( empty($(input).val()) ) {
				$(input).parent().addClass('has-error');
				err++;
			} else {
				$(input).parent().removeClass('has-error');
			};
		});

		if ( err > 0 ) {
			bootbox.alert('Harap lengkapi data terlebih dahulu.');
		} else {
			bootbox.confirm('Apakah anda yakin ingin menyimpan data ?', function(result){
				if (result) {
					var nama_parent = $('input#nama_parent').val();
					var detail_fitur = $.map($('table.detail tbody tr'), function(tr){
						var data_detail = {
							'no_urut' : $(tr).find('input#no_urut').val(),
							'nama_fitur' : $(tr).find('input#nama_fitur').val(),
							'path_fitur' : $(tr).find('input#path_fitur').val()
						};

						return data_detail;
					});

					var data = {
						'nama_parent' : nama_parent,
						'detail_fitur' : detail_fitur
					};

					ki.exec_save(data);
				};
			});
		};
	}, // end - save

	exec_save: function(data) {
		$.ajax({
			url : 'master/KomponenIuran/save_data',
			dataType: 'json',
			type: 'post',
			data: {
				'params' : data
			},
			beforeSend : function(){
				showLoading();
			},
			success : function(data){
				hideLoading();
				if ( data.status == 1 ) {
					bootbox.alert(data.message, function(){
						ki.getLists();
						bootbox.hideAll();
					});
				} else {
					bootbox.alert(data.message);
				}
			}
		});
	}, // end - exec_save

	edit: function () {
		var err = 0;
		$.map( $('input[data-required=1]'), function(input){
			if ( empty($(input).val()) ) {
				$(input).parent().addClass('has-error');
				err++;
			} else {
				$(input).parent().removeClass('has-error');
			};
		});

		if ( err > 0 ) {
			bootbox.alert('Harap lengkapi data terlebih dahulu.');
		} else {
			bootbox.confirm('Apakah anda yakin ingin menyimpan data ?', function(result){
				if ( result ) {
					var id_parent = $('input#nama_parent').data('id');
					var nama_parent = $('input#nama_parent').val();
					var detail_fitur = $.map($('table.detail tbody tr'), function(tr){
						var data_detail = {
							'id_detfitur' : $(tr).data('iddet'),
							'no_urut' : $(tr).find('input#no_urut').val(),
							'nama_fitur' : $(tr).find('input#nama_fitur').val(),
							'path_fitur' : $(tr).find('input#path_fitur').val()
						};

						return data_detail;
					});

					var data = {
						'id_parent' : id_parent,
						'nama_parent' : nama_parent,
						'detail_fitur' : detail_fitur
					};

					ki.exec_edit(data);
				};
			});
		};
	}, // end - edit

	exec_edit: function(data) {
		$.ajax({
			url : 'master/KomponenIuran/edit_data',
			dataType: 'json',
			type: 'post',
			data: {
				'params' : data
			},
			beforeSend : function(){
				showLoading();
			},
			success : function(data){
				hideLoading();
				if ( data.status == 1 ) {
					bootbox.alert(data.message, function(){
						ki.getLists();
						bootbox.hideAll();
					});
				} else {
					bootbox.alert(data.message);
				}
			}
		});
	}, // end - exec_edit

	delete: function(elm) {
		var btn_delete = $(elm);
		var tr = $(btn_delete).closest('tr');

		var id_fitur = $(tr).find('td.id_fitur').html();

		bootbox.confirm('Apakah anda yakin ingin menghapus data ?', function(result){
			if ( result ) {
				$.ajax({
					url : 'master/KomponenIuran/delete_data',
					dataType: 'json',
					type: 'post',
					data: {
						'params' : id_fitur
					},
					beforeSend : function(){
						showLoading();
					},
					success : function(data){
						hideLoading();
						if ( data.status == 1 ) {
							bootbox.alert(data.message, function(){
								ki.getLists();
								bootbox.hideAll();
							});
						} else {
							bootbox.alert(data.message);
						}
					}
				});
			};
		});

	}, // end - delete
};

ki.startUp();